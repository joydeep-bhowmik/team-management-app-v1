<?php
namespace App\Livewire\Datatables;

use App\Models\Attendence;
use App\Models\AttendenceRequest;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use JoydeepBhowmik\LivewireDatatable\Datatable;
use Livewire\Attributes\On;
use Mary\Traits\Toast;

class AttendenceRequestsTable extends Datatable
{
    use Toast;

    protected $listeners = ['refresh-attendence-requests' => '$refresh'];

    public function builder()
    {

        $user = auth()->user();

        if ($user && ($user->isAdmin() || $user->designation?->name === 'frontdesk')) {
            return AttendenceRequest::query()
                ->with('user')
                ->whereHas('user')
                ->latest();
        }
        return AttendenceRequest::query()
            ->where('user_id', $user?->id)
            ->with('user')
            ->latest();
    }
    public function mount()
    {
        $this->setup();
    }

    public function approve(string $id)
    {

        if (! (auth()->user()->isAdmin() || auth()->user()->hasDesignation('frontdesk'))) {

            return abort(403);
        }

        $attendenceRequest = AttendenceRequest::find($id);

        if ($attendenceRequest) {

            $attendence = Attendence::whereDate('created_at', Carbon::parse($attendenceRequest->created_at))
                ->where('user_id', $attendenceRequest->user_id)
                ->first() ?? new Attendence();

            if ($attendenceRequest->type == 'checkin') {

                $attendence->in_time = $attendenceRequest->time;
            }

            if ($attendenceRequest->type == 'checkout') {

                $attendence->out_time = $attendenceRequest->time;
            }

            $attendence->user_id = $attendenceRequest->user_id;

            $attendence->status = 'present';

            if ($attendence->save()) {

                $attendenceRequest->status = 'approved';
                $attendenceRequest->save();
                $this->success('Attendence Requests Approved');
            }
        }
    }
    public function dispatchCancel(string $id)
    {

        return $this->dispatch('confirm', subtitle: 'Are you sure to cancel attendence', eventToEmit: 'cancel', data: [$id]);
    }

    #[On('cancel')]
    public function cancel(string $id)
    {

        $attendenceRequest = AttendenceRequest::find($id);

        if ($attendenceRequest) {
            $attendenceRequest->status = 'cancelled';

            if ($attendenceRequest->save()) {
                $this->success('Attendence Requests Cancelled');
            }
        }
    }

    public function table()
    {
        // table method must return an array
        return [

            $this->field('')
                ->value(function ($row) {

                    //approved

                    $approvveButton = "<x-button spinner  wire:click='approve(`{{" . $row->id . "}}`)' class='btn-primary' >Approve</x-button>";

                    $cancelButton = "<x-button  spinner  wire:click='dispatchCancel(`{{" . $row->id . "}}`)'>Cancel</x-button>";

                    $blade = auth()->user()->isAdmin() || auth()->user()->hasDesignation('frontdesk') ? $approvveButton . $cancelButton : $cancelButton;

                    if ($row->status !== 'pending') {

                        $blade = match ($row->status) {

                            'declined'  => '<x-badge value="Declined" />',
                            'cancelled' => '<x-badge value="Cancelled" class="badge-error"/>',
                            'approved'  => '<x-badge value="Approved" class="badge-success" />',
                        };
                    }

                    return Blade::render($blade);
                }),
            // id field
            $this->field('avatar')
                ->label('Avatar')
                ->value(function ($row) {

                    $user = $row->user;

                    return $user->avatar ? '<img src="' . $user->avatar . '" alt="Avatar" width="50" />' : 'None';
                }),

            $this->field('Name')
                ->value(function ($row) {

                    $user = $row->user;
                    return $user->name;
                })->searchable(function ($q, $keyword) {

                $q->whereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%");
                });
            }),

            $this->field('type')->label('Type')->searchable(),
            $this->field('time')
                ->label('Time')
                ->value(function ($row) {

                    return $row->time?->format('h:i A');
                }),
            // created at
            $this->field('created_at')
                ->label('Created At')
                ->value(function ($row) {
                    return $row->created_at->format('d M, Y');
                })
                ->sortable(),

            // created at
            $this->field('updated_at')
                ->label('Updated At')
                ->value(function ($row) {
                    return $row->updated_at->format('d M, Y');
                })
                ->sortable(),
        ];
    }

    public function filters()
    {

        return [
            $this->filter('date')
                ->label('Date')
                ->type('date')
                ->query(function ($query, $value) {
                    $query->whereDate('created_at', $value);
                }),
        ];
    }
}
