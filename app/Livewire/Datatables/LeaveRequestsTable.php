<?php
namespace App\Livewire\Datatables;

use App\Models\LeaveApplication;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use JoydeepBhowmik\LivewireDatatable\Datatable;
use Livewire\Attributes\On;
use Mary\Traits\Toast;

class LeaveRequestsTable extends Datatable
{
    use Toast;


    public function toggleapproved(string $id)
    {
        $user = auth()->user();



        if (!$user->canReview()) {
            return;
        }

        $leaveApplication = LeaveApplication::find($id);

        if (!$leaveApplication) {
            return $this->error('Leave application not found.');
        }

        $isapproved = !is_null($leaveApplication->approved_by);

        if ($isapproved) {
            $leaveApplication->declined_by = $user->id;
            $leaveApplication->approved_by = null;
        } else {
            $leaveApplication->approved_by = $user->id;
            $leaveApplication->declined_by = null;
        }



        if ($leaveApplication->save()) {
            return $this->success(
                $isapproved ? 'Marked as declibed.' : 'Marked as approved.'
            );
        }

        return $this->error('Unable to update leave application.');
    }


    #[On('declined')]
    public function declined(string $id)
    {
        $leaveApplication = LeaveApplication::find($id);

        if ($leaveApplication) {
            $leaveApplication->status = 'declined';
            $leaveApplication->declined_by = auth()->id();

            if ($leaveApplication->save()) {
                $this->success('Leave Request declined');
            } else {
                $this->error('Unable to decline leave request.');
            }
        }
    }


    public function builder()
    {

        $user = auth()->user();

        if ($user && ($user->isAdmin() || $user->canReview())) {
            return LeaveApplication::query()
                ->with('user')
                ->whereHas('user')
                ->latest();
        }
        return LeaveApplication::query()
            ->where('user_id', $user?->id)
            ->with('user')
            ->latest();
    }
    public function mount()
    {
        $this->setup();
    }

    #[On('approve')]
    public function approve(string $id)
    {

        if (!(auth()->user()->isAdmin())) {

            return abort(403);
        }

        $LeaveApplication = LeaveApplication::find($id);

        if ($LeaveApplication) {

            $LeaveApplication->status = 'approved';

            if ($LeaveApplication->save()) {

                $this->success('Leave Applicaton Approved');
            }
        }
    }

    public function dispatchApprove(string $id)
    {

        return $this->dispatch('confirm', subtitle: 'Are your sure to approve?', eventToEmit: 'approve', data: [$id]);
    }

    public function dispatchDecline(string $id)
    {

        return $this->dispatch('confirm', subtitle: 'Are you sure to decline the request', eventToEmit: 'declined', data: [$id]);
    }




    public function table()
    {
        // table method must return an array
        return [

            $this->field('Status')
                ->value(function ($row) {

                    //approved
        
                    $approvveButton = "<x-button spinner  wire:click='dispatchApprove(`{{" . $row->id . "}}`)' class='btn-primary' >Approve</x-button>";

                    $declinedButton = "<x-button  spinner  wire:click='dispatchDecline(`{{" . $row->id . "}}`)'>Decline</x-button>";

                    $blade = auth()->user()->isAdmin() ? $approvveButton . $declinedButton : '<x-badge value="' . $row->status . '" />';

                    if ($row->status !== 'pending') {

                        $blade = match ($row->status) {

                            'declined' => '<x-badge value="Declined" />',
                            'approved' => '<x-badge value="Approved" class="badge-success" />',
                        };
                    }
                    $blade = match ($row->status) {
                        'pending' => auth()->user()->isAdmin() ? $approvveButton . $declinedButton : '<x-badge value="Pending" />',
                        'declined' => '<x-badge value="Declined" />',




                        'approved' => '<x-badge value="Approved" class="badge-success" />',
                    };

                    return Blade::render($blade);
                }),

            auth()->user()->canReview() ? $this->field('HR opinion')
                ->value(function ($row) {
                    $approved = $row->approved_by ? "approved by {$row->approver?->name}" : 'Not approved';
                    $declined = $row->declined_by ? "Declined by {$row->decliner?->name}" : 'Not declined';

                    $label = $row->approved_by ? 'Decline' : 'Approve';

                    $class = $row->approved_by ? 'btn-secondary' : 'btn-primary';

                    $button = <<<HTML
            <div>
                <x-button spinner wire:click="toggleapproved('{$row->id}')" class="{$class}">
                    {$label}
                </x-button>
                <div class="text-xs text-gray-500 mt-1">
                    {$approved} | {$declined}
                </div>
            </div>
        HTML;

                    return Blade::render($button);
                }) : $this->field(''),



            // id field
            $this->field('avatar')
                ->label('Avatar')
                ->value(function ($row) {

                    $user = $row?->user;

                    return $user?->avatar ? '<img src="' . $user?->avatar . '" alt="Avatar" width="50" />' : 'None';
                }),

            $this->field('Name')
                ->value(function ($row) {

                    $user = $row?->user;
                    return $user?->name ?? 'deleted user';
                })->searchable(function ($q, $keyword) {

                    $q->whereHas('user', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%$keyword%");
                    });
                }),
            $this->field('reason')->label('Reason')->value(function ($row) {
                return <<<HTML
                    <div x-data="{ showModal: false }">
                        <!-- Trigger Button -->
                        <button @click="showModal = true" style="color: blue; text-decoration: underline; cursor: pointer; background: none; border: none;">
                            View
                        </button>

                        <!-- Modal -->

                       <div  x-show="showModal">
                        <div  style="position: fixed; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0, 0, 0, 0.5); z-index: 1000;">
                            <div style="background: white; padding: 20px; border-radius: 8px; max-width: 400px; width: 100%;">
                                <h3 style="margin-bottom: 10px;">Reason</h3>
                                <div style="max-height: 300px; overflow-y: auto; white-space: pre-wrap; max-height:400px;overflow-y:auto">
                                    {$row->reason}
                                </div>
                                <button @click="showModal = false" style="margin-top: 10px; display: block; padding: 5px 10px; background: red; color: white; border: none; cursor: pointer;">
                                    Close
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>
                HTML;
            }),

            $this->field('type')->label('Type')->searchable(),

            $this->field('dates')
                ->label('Dates')
                ->value(function ($row) {
                    $dates = json_decode($row->dates, true);

                    $d = join(',', $dates);
                    return $d;
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

            $this->filter('approved')
                ->label('approved')
                ->type('select')
                ->options([
                    'all' => 'All',
                    'approved' => 'approved',
                    'not_approved' => 'Not approved',
                ])
                ->query(function ($query, $value) {
                    if ($value === 'approved') {
                        $query->whereNotNull('approved_by');
                    } elseif ($value === 'not_approved') {
                        $query->whereNull('approved_by');
                    }
                }),
        ];
    }
}
