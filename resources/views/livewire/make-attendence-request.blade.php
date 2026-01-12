<?php

use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Illuminate\Support\Carbon;
use App\Models\AttendenceRequest;

new class extends Component {
    use Toast;

    public bool $showModal = false;
    public string $type;

    function refresh()
    {
        $this->dispatch('refresh-attendence-requests');
    }

    function create()
    {
        $this->validate(['type' => 'required|in:checkin,checkout']);

        $checkinTimeLimit = env('CHECKIN_TIME_LIMIT', '10:06'); // Default value is '10:06'
        [$hour, $minute] = explode(':', $checkinTimeLimit);

        if ($this->type == 'checkin' && Carbon::now()->gt(Carbon::today()->setTime((int) $hour, (int) $minute))) {
            $this->showModal = false;
            $this->error('Checkin requests can only be made before ' . $checkinTimeLimit . ' AM.');
            return;
        }

        $userId = auth()->user()->id;

        // Check if there is an approved or pending attendance request
        $existingRequest = AttendenceRequest::whereDate('created_at', Carbon::today())
            ->where('user_id', $userId)
            ->where('type', $this->type)
            ->whereIn('status', ['approved', 'pending']) // Check for approved or pending status
            ->first();

        // Provide specific error messages
        if ($existingRequest) {
            if ($existingRequest->status === 'approved') {
                $this->showModal = false;
                $this->error('Request already approved', 'No further requests are allowed for today. ');
            } elseif ($existingRequest->status === 'pending') {
                $this->showModal = false;
                $this->error('Already have a pending  Request', ' Please wait for approval or cancel it before creating a new one.');
            }
            return;
        }

        // If no approved or pending request, create a new attendance request
        $attendenceRequest = $existingRequest ?? new AttendenceRequest();
        $attendenceRequest->user_id = $userId;
        $attendenceRequest->type = $this->type;
        $attendenceRequest->time = now();
        $attendenceRequest->status = 'pending'; // Set status to pending for new requests

        if ($attendenceRequest->save()) {
            $this->showModal = false;
            $this->success('Attendance Request Created.');
            $this->dispatch('refresh-attendence-requests');
        } else {
            $this->error('Failed to create Attendance Request.');
        }
    }
};
?>

<x-card title=' '>



    <x-modal wire:model='showModal' title="Create Attendance Request">

        <x-radio label="Type" :options="[
            [
                'id' => 'checkin',
                'name' => 'Checkin',
            ],
            [
                'id' => 'checkout',
                'name' => 'Checkout',
            ],
        ]" wire:model="type" />

        <x-slot:actions>

            <x-button class="btn-primary" wire:click='create' spinner>Create</x-button>
        </x-slot:actions>
    </x-modal>


    <x-slot:menu>
        <x-button wire:click='refresh' icon="o-arrow-path" spinner />
        <x-button wire:click='showModal=true' spinner icon="o-plus" />
    </x-slot:menu>

    <livewire:datatables.AttendenceRequestsTable />
</x-card>
