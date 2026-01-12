@props(['user_id'])

<?php

use Carbon\Carbon;
use Livewire\Volt\Component;
use App\Models\LeaveApplication;
use App\Models\AttendenceRequest;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public string $user_id = '';
    public $monthlyAttendance = [];
    public $year;
    public array $years = [];

    public function mount($user_id): void
    {
        $this->user_id = $user_id;
        $this->initializeYears();
        $this->year = request('year', now()->year);
        $this->calculateAttendance();
    }

    private function initializeYears(): void
    {
        // Get years from attendance records
        $firstAttendanceYear = DB::table('attendence_requests')->selectRaw('MIN(YEAR(time)) as year')->value('year');

        // Get years from leave applications
        $firstLeaveYear = DB::table('leave_applications')->selectRaw('MIN(YEAR(created_at)) as year')->value('year');

        // Get the earliest year from both tables
        $startYear = min($firstAttendanceYear ?? now()->year, $firstLeaveYear ?? now()->year, now()->year);

        $currentYear = now()->year;

        $years = range($startYear, $currentYear);

        $this->years = collect($years)
            ->reverse() // Show most recent years first
            ->map(
                fn($year) => [
                    'id' => $year,
                    'name' => $year,
                ],
            )
            ->toArray();
    }

    public function updatedYear(): void
    {
        $this->calculateAttendance();
    }

    private function calculateAttendance(): void
    {
        $userId = $this->user_id;
        $year = $this->year;

        // Fetch attendance counts
        $attendance = AttendenceRequest::selectRaw(
            "MONTH(time) as month,
            COUNT(DISTINCT CASE 
                WHEN WEEKDAY(time) = 6 THEN time
                WHEN type IN ('checkin', 'checkout') THEN DATE(time) 
            END) as total_present",
        )
            ->whereYear('time', $year)
            ->where('user_id', $userId)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_present', 'month');

        // Fetch approved leave counts
        $approvedLeaves = LeaveApplication::where('status', 'approved')->whereYear('created_at', $year)->where('user_id', $userId)->get()->flatMap(fn($leave) => json_decode($leave->dates, true))->groupBy(fn($date) => Carbon::parse($date)->month)->map->count();

        // Calculate Sundays for each month
        $sundaysCount = collect(range(1, 12))->mapWithKeys(function ($month) use ($year) {
            $startOfMonth = Carbon::create($year, $month, 1);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            $sundays = collect();
            while ($startOfMonth <= $endOfMonth) {
                if ($startOfMonth->isSunday()) {
                    $sundays->push($startOfMonth);
                }
                $startOfMonth->addDay();
            }

            return [$month => $sundays->count()];
        });

        // Fetch event counts
        $eventCounts = DB::table('events')->whereYear('date', $year)->groupBy(DB::raw('MONTH(date)'))->select(DB::raw('MONTH(date) as month'), DB::raw('COUNT(*) as event_count'))->pluck('event_count', 'month');

        // Merge attendance, leave counts, Sundays count, and event counts
        $this->monthlyAttendance = collect(range(1, 12))->mapWithKeys(
            fn($month) => [
                $month => [
                    'attendance' => $attendance[$month] ?? 0,
                    'approved_leaves' => $approvedLeaves[$month] ?? 0,
                    'sundays' => $sundaysCount[$month] ?? 0,
                    'events' => $eventCounts[$month] ?? 0,
                    'month_name' => Carbon::create()->month($month)->format('F'),
                ],
            ],
        );
    }
};

?>
<div {{ $attributes }}>
    @volt('attendance-details')
        <x-card title="Attendance Details">



            <div class="space-y-6">

                <x-slot:menu>
                    <x-select wire:model.live="year" :options="$years" option-value="id" option-label="name" class="w-32" />
                </x-slot:menu>

                <x-progress class="progress-primary h-1" indeterminate wire:loading />

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($monthlyAttendance as $month => $data)
                        @php
                            $totalDaysInMonth = Carbon::createFromDate($this->year, $month, 1)->daysInMonth;
                            $total =
                                $data['attendance'] + $data['approved_leaves'] + $data['sundays'] + $data['events'];

                            // Calculate percentage
                            $percentage = $totalDaysInMonth > 0 ? round(($total / $totalDaysInMonth) * 100) : 0;

                            // Determine color based on percentage
                            $cardClass = 'card ';
                            if ($percentage >= 80) {
                                $cardClass .= 'bg-success text-white';
                            } elseif ($percentage >= 60) {
                                $cardClass .= 'bg-warning text-white';
                            } else {
                                $cardClass .= 'bg-error text-white';
                            }
                        @endphp
                        <div class="{{ $cardClass }}">
                            <div class="card-body">
                                <h2 class="card-title">{{ $data['month_name'] }}</h2>

                                <div class="space-y-2">
                                    <p class="flex justify-between">
                                        <span>Attendance:</span>
                                        <span class="font-bold">{{ $data['attendance'] }} days</span>
                                    </p>
                                    <p class="flex justify-between">
                                        <span>Approved Leaves:</span>
                                        <span class="font-bold">{{ $data['approved_leaves'] }} days</span>
                                    </p>
                                    <p class="flex justify-between">
                                        <span>Sundays:</span>
                                        <span class="font-bold">{{ $data['sundays'] }} days</span>
                                    </p>
                                    <p class="flex justify-between">
                                        <span>Events:</span>
                                        <span class="font-bold">{{ $data['events'] }} events</span>
                                    </p>

                                    <x-hr class="my-3" />

                                    <div class="space-y-2">
                                        <p class="flex justify-between text-lg">
                                            <span>Total:</span>
                                            <span class="font-bold">{{ $total }} / {{ $totalDaysInMonth }}</span>
                                        </p>
                                        <div class="flex items-center space-x-2">
                                            <x-progress class="progress-accent flex-1" value="{{ $percentage }}" />
                                            <span class="text-sm font-medium">{{ $percentage }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </x-card>
    @endvolt
</div>
