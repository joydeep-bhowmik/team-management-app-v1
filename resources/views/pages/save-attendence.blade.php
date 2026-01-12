<?php

use App\Models\User;
use Mary\Traits\Toast;
use App\Models\Attendence;
use Livewire\Volt\Component;
use Illuminate\Support\Carbon;

new class extends Component {
    use Toast;

    public string|null $id = null;

    public string|null $user_id;

    public string|null $in_time;

    public string|null $out_time = null;

    public string|null $status;

    function mount()
    {
        $this->id = request('id');

        $attendence = Attendence::find($this->id);

        if ($this->id && !$attendence) {
            return abort(404);
        }

        if ($attendence) {
            $this->user_id = $attendence->user_id;

            $this->in_time = $attendence->in_time?->format('H:i');

            $this->out_time = $attendence->out_time?->format('H:i');

            $this->status = $attendence->status;
        }
    }

    function save()
    {
        $this->validate([
            'user_id' => 'required',
            'in_time' => 'required',
            'out_time' => 'nullable',
            'status' => 'required|in:present, half_day, absent',
        ]);

        if (!auth()->user()->isAdmin()) {
            $checkinTimeLimit = env('CHECKIN_TIME_LIMIT', '10:06'); // Default value is '10:06'
            [$hour, $minute] = explode(':', $checkinTimeLimit);

            if ($this->in_time && Carbon::now()->gt(Carbon::today()->setTime((int) $hour, (int) $minute))) {
                $this->showModal = false;
                $this->error('Checkin requests can only be made before ' . $checkinTimeLimit . ' AM.');
                return;
            }
        }

        $attendence = Attendence::find($this->id) ?? new Attendence();

        $attendence->user_id = $this->user_id;

        $in_time = Carbon::createFromFormat('H:i', $this->in_time)->format('Y-m-d H:i:s');
        $out_time = $this->out_time ? Carbon::createFromFormat('H:i', $this->out_time)->format('Y-m-d H:i:s') : null;

        $attendence->in_time = $in_time;
        $attendence->out_time = $out_time;

        $attendence->status = $this->status;

        if ($attendence->save()) {
            $this->success('Saved');
            !$this->id && $this->redirect(route('attendences.edit', $attendence->id), navigate: true);
        }
    }

    function with()
    {
        $users = User::all()->map(function ($user) {
            $user->name = $user->name . ' #' . $user->uniqid;
            return $user;
        });
        $attendence = Attendence::find($this->id);

        return compact('users', 'attendence');
    }
};

?>

<x-app-layout>

    @volt('save-Attendences')
        <x-slot:title>{{ ($id ? 'Edit' : 'Create') . ' Attendences' }}</x-slot:title>
        <div>
            <x-card :title="($id ? 'Edit' : 'Create') . ' Attendences'">
                <x-slot:menu>
                    <x-button wire:click='save' spinner>Save</x-button>
                </x-slot:menu>
                <div class="space-y-5">
                    <x-choices label="Employee" wire:model="user_id" :options="$users" single />

                    <x-datetime label="In time" wire:model="in_time" icon="o-calendar" type="time" />

                    <x-datetime label="Out time" wire:model="out_time" icon="o-calendar" type="time" />

                    <x-radio label="Status" :options="[
                        ['id' => 'present', 'name' => 'Present'],
                        ['id' => 'half_day', 'name' => 'Half Day'],
                        ['id' => 'absent', 'name' => 'Absent'],
                    ]" wire:model="status" />

                </div>

            </x-card>

            @if ($attendence)
                <x-card class="mt-5" title="Timings">
                    <div class="space-y-3">


                        <div>
                            <b>Created at :</b> {{ $attendence->created_at->format('d M, Y h:i A') }}
                        </div>

                        <div>
                            <b>Updated at :</b> {{ $attendence->updated_at->format('d M, Y h:i A') }}
                        </div>
                    </div>
                </x-card>
            @endif
        </div>
    @endvolt
</x-app-layout>
