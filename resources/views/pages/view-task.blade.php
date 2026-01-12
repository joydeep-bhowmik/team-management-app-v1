<?php

use App\Models\Task;
use Mary\Traits\Toast;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public $id;
    use Toast;
    function mount()
    {
        $this->id = request('id');
    }
    #[On('markAsDone')]
    function markAsDone()
    {
        $task = Task::find($this->id);

        $task->status = 'completed';

        $task->save() && $this->success('Task marked as completed');
    }
    #[On('markAsCancelled')]
    function markAsCancelled()
    {
        $task = Task::find($this->id);

        $task->status = 'cancelled';

        $task->save() && $this->success('Task marked as cancelled');
    }

    function dispatchCancel()
    {
        $this->dispatch('confirm', subtitle: 'Are you sure to cancel this task ? This action can be undone', eventToEmit: 'markAsCancelled');
    }

    function dispatchDone()
    {
        $this->dispatch('confirm', subtitle: 'Are you sure to mark as done this task ? This action can be undone', eventToEmit: 'markAsDone');
    }

    function with(): array
    {
        $task = Task::where('id', $this->id)
            ->with(['assigner', 'assignee'])
            ->first();

        if (!$task) {
            abort(
                404,
                'Task not found yo
            ',
            );
        }

        $user = auth()->user();

        if (!($user->isAdmin() || $user->isAssigner($task) || $user->isAssignee($task) || $user->hasDesignation('Operation Manager'))) {
            abort(403, 'Forbidden');
        }

        return compact('task');
    }

    function ping()
    {
        $task = Task::find($this->id);

        $task->assignee()->sendTaskReminder($task) && $this->success('Reminder Sent successfully!');
    }
};
?>

<x-app-layout>
    @volt('view-task')
        <div>
            <x-slot:title>View Task {{ $task->title }}</x-slot:title>
            <x-layout cols="form" :title="ucfirst($task->title)">

                <x-slot name="action">



                    @if (auth()->user()->isAssignee($task) && $task->status != 'completed')
                        <x-button class="mt-5" wire:click='dispatchDone' spinner>Mark as
                            done</x-button>
                    @endif

                    @if (auth()->user()->isAssigner($task))
                        <x-button class="mt-5" :link="route('tasks.edit', $task->id)" icon="o-pencil">Edit</x-button>
                        @if ($task->status != 'completed')
                            <x-button class="mt-5" wire:click='dispatchCancel' spinner>Cancel</x-button>
                        @endif
                    @endif

                </x-slot>

                <div class="space-y-5">

                    <x-card>

                        <div>
                            @if ($task->description)
                                @php
                                    $Parsedown = new Parsedown();

                                @endphp
                                <div class="prose prose-lg">{!! $Parsedown->text($task->description) !!}</div>
                            @endif

                        </div>

                    </x-card>


                    <x-card title="Discussion" class="mt-5">

                        <livewire:conversation :model="$task" :users="[$task->assignee()->first(), $task->assigner()->first()]" :currentPageUrl="route('tasks.view', $task->id)" />
                    </x-card>

                </div>

                <div class="space-y-5">

                    @if ($task->status)
                        <x-card title="Status">
                            @php
                                $statusColor = 'gray';
                                $statusColors = [
                                    'pending' => 'gray',
                                    'completed' => 'green',

                                    'cancelled' => 'red',
                                ];

                                $taskStatus = $task->status;

                                if (array_key_exists($taskStatus, $statusColors)) {
                                    $statusColor = $statusColors[$taskStatus];
                                }
                            @endphp
                            <div class="w-fit rounded-full border-2 px-5 py-1 capitalize"
                                style="border-color:{{ $statusColor }}">
                                {{ $task->status }}
                            </div>
                        </x-card>
                    @endif

                    @if ($task->priority)
                        @php
                            $color = 'yellow';

                            if ($task->priority == 'medium') {
                                $color = 'green';
                            }

                            if ($task->priority == 'high') {
                                $color = 'red';
                            }
                        @endphp
                        <x-card title="Priority">

                            <div class="w-fit rounded-full border-2 px-5 py-1 capitalize"
                                style="border-color:{{ $color }}">
                                {{ $task->priority }}
                            </div>
                        </x-card>
                    @endif

                    <x-card title="Assiger & assignee">
                        <div class="mt-5 flex flex-col items-center justify-center gap-1">



                            <x-avatar-with-name class="dark:bg-gray-800" x-navigate :href="$task->assigner ? route('employees.view', $task->assigner->id) : ''" :user="$task->assigner" />
                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M13.0001 16.1716L18.3641 10.8076L19.7783 12.2218L12.0001 20L4.22192 12.2218L5.63614 10.8076L11.0001 16.1716V4H13.0001V16.1716Z">
                                </path>
                            </svg>

                            <x-avatar-with-name class="dark:bg-gray-800" x-navigate :href="$task->assignee ? route('employees.view', $task->assignee->id) : ''" :user="$task->assignee" />

                        </div>
                    </x-card>

                    <x-card title="Dates">

                        <div class="flex flex-wrap items-center gap-4">

                            <span><b>Created At:</b> {{ $task->created_at?->format('d M, Y h:i A') }}</span>

                            <span><b>Updated At:</b> {{ $task->updated_at?->format('d M, Y h:i A') }}</span>


                            <span><b>Due Date : </b>{{ $task->due_date?->format('d M,Y') }}</span>
                        </div>
                    </x-card>
                </div>
            </x-layout>


        </div>
    @endvolt


</x-app-layout>
