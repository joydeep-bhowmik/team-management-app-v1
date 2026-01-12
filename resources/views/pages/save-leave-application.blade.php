<?php

use Carbon\Carbon;
use App\Models\Event;
use Mary\Traits\Toast;
use Livewire\Volt\Component;
use App\Models\LeaveApplication;
use Illuminate\Support\Collection;

new class extends Component {
    use Toast;
    public string $type;

    public string|null $reason = null;

    public bool $showModal = false;

    public $dates;

    public string $date = '';

    function mount()
    {
        $this->dates = collect([]);
    }

    function pickDate()
    {
        $this->resetErrorBag('date');
        $selectedDate = Carbon::parse($this->date);
        $formattedDate = $selectedDate->format('Y-m-d');
        $monthDay = $selectedDate->format('m-d');

        // Check if the selected date is a Sunday
        if ($selectedDate->isSunday()) {
            $this->addError('date', 'You cannot pick a Sunday!');
            return;
        }

        if ($this->dates->isNotEmpty()) {
            $firstDate = Carbon::parse($this->dates->first());
            $firstDateMonth = $firstDate->format('m');
            $firstDateYear = $firstDate->format('Y');

            if ($selectedDate->format('m') !== $firstDateMonth || $selectedDate->format('Y') !== $firstDateYear) {
                $this->addError('date', 'All dates must be within the same month and year!');
                return;
            }
        }

        // Check for events that match the selected date
        $event = Event::where(function ($query) use ($formattedDate, $monthDay) {
            // Check for one-time events (specific year)
            $query->where('date', $formattedDate)->where('repeat', false);
        })
            ->orWhere(function ($query) use ($monthDay) {
    // Check for recurring yearly events (any year)
    $query->whereRaw("CONVERT(DATE_FORMAT(date, '%m-%d') USING utf8mb4) COLLATE utf8mb4_unicode_ci = ?", [$monthDay])
          ->where('repeat', true);
})
->first();


        if ($event) {
            $this->addError('date', 'This date is associated with an event and cannot be picked!');
            return;
        }

        // Add the date if it's valid
        $this->dates->push($this->date);
        $this->dates = $this->dates->unique();

        $this->showModal = false;
    }

    function removeDate(string $date)
    {
        $this->dates = $this->dates->reject(function ($value) use ($date) {
            return $value == $date;
        });
    }

    function create()
    {
        $this->validate([
            'type' => 'required|in:SL,EL,CL',
            'dates' => 'required|array|min:1',
            'dates.*' => 'required|date',
            'reason' => 'nullable',
        ]);

        $user = auth()->user();

        $epr = $user->epr()?->latest();

        $epr = $epr?->first()?->value;

        if ($epr && $epr < 8) {
            $this->addError('dates', "Your EPR is {$epr}, which is below 8, so you are not eligible to apply for leave.");

            return;
        }

        // Check if user joined within the last 2 months
        $joiningDate = Carbon::parse($user->joining_date); // Assuming you have a `joining_date` field
        $currentDate = Carbon::now();

        // If the user joined within the last 2 months, prevent leave application
        // if ($joiningDate->diffInMonths($currentDate) < 2) {
        //     $this->addError('type', 'You cannot apply for leave during your provision period (first 2 months).');
        //     return;
        // }

        $leaveDates = collect($this->dates)->map(fn($date) => Carbon::parse($date));
        $currentYear = now()->year;
        // Check leave limits

        $leaveCount = LeaveApplication::where('user_id', $user->id)
            ->where('type', $this->type)
            ->whereYear('created_at', $currentYear)
            ->where('status', 'approved') // Only consider approved leaves
            ->get()
            ->flatMap(fn($application) => json_decode($application->dates)) // Decode JSON dates field
            ->count();
        $user_designation = $user->designation()?->first();

        $leaveLimits = [
            'EL' => $user_designation?->EL ?? 0,
            'SL' => $user_designation?->SL ?? 0,
            'CL' => $user_designation?->CL ?? 0,
        ];

        if ($leaveCount + $leaveDates->count() > $leaveLimits[$this->type]) {
            $this->addError('type', 'You can apply for ' . (isset($leaveLimits[$this->type]) && $leaveLimits[$this->type] > 0 ? $leaveLimits[$this->type] : 'no') . " {$this->type} leaves in a year.");

            return;
        }

        $requestedMonth = $leaveDates->first()->format('Y-m');

        $existingApproved = LeaveApplication::where('user_id', $user->id)
            ->where('status', 'approved')
            ->get()
            ->filter(function ($leave) use ($requestedMonth) {
                $dates = json_decode($leave->dates, true);
                foreach ($dates as $date) {
                    if (\Carbon\Carbon::parse($date)->format('Y-m') === $requestedMonth) {
                        return true;
                    }
                }
                return false;
            })
            ->isNotEmpty();

        // if ($existingApproved) {
        //     $this->addError('type', 'You can take only one type of leave every month.');
        //     return;
        // }

        // Specific validations based on leave type
        if ($this->type === 'EL') {
            $minStartDate = Carbon::now()->addDays(3);
            if ($leaveDates->contains(fn($date) => $date->lt($minStartDate))) {
                $this->addError('dates', 'EL must be applied at least 3 days in advance.');
                return;
            }
        }

        if (in_array($this->type, ['SL', 'CL'])) {
            if (!$leaveDates->every(fn($date) => $date->isToday() || $date->isPast())) {
                $this->addError('dates', 'SL and CL can only be applied for today or past days, not future days.');
                return;
            }
        }

        // Save the leave application
        $application = new LeaveApplication();
        $application->user_id = $user->id;
        $application->type = $this->type;
        $application->dates = json_encode($this->dates); // JSON column
        $application->reason = $this->reason;

        if ($application->save()) {
            $this->success('Application submitted successfully.');
        }
    }
};
?>


<x-app-layout title="Leave Application">


    @volt('save-leave-application')
        <div>
            <x-header title="Create leave application">
                <x-slot:actions>
                    <x-button wire:click='create' spinner>Create</x-button>
                </x-slot:actions>
            </x-header>


            <x-card>
                <div class="space-y-5">

                    <x-button x-data @click="$wire.showModal = true">Pick Dates</x-button>

                    <x-modal wire:model='showModal' title="Choose Date">

                        <x-datetime wire:model='date' />

                        <x-slot:actions>
                            <x-button class="btn-primary" wire:click='pickDate' spinner>Pick</x-button>

                        </x-slot:actions>

                    </x-modal>


                    <div class="flex items-center flex-wrap gap-5">
                        @foreach ($dates as $date)
                            <div class="flex items-center border rounded-md p-2 gap-5">
                                {{ $date }}

                                <x-button icon='o-trash' wire:click='removeDate(`{{ $date }}`)' spinner />
                            </div>
                        @endforeach
                    </div>


                    @error('dates')
                        <div class="text-xs text-red-600"> {{ $message }}</div>
                    @enderror

                    <x-select :options="[
                        ['id' => '', 'name' => 'select'],
                        ['id' => 'SL', 'name' => 'SL'],
                        ['id' => 'CL', 'name' => 'CL'],
                        ['id' => 'EL', 'name' => 'EL'],
                    ]" label="Type" wire:model='type' />




                    <x-textarea label="Reason" wire:model='reason' />
                </div>
            </x-card>

        </div>
    @endvolt
</x-app-layout>
