@php
    use App\Models\Task;
    use App\Models\User;

    $number_of_employees = User::where('role', 'employee')->count();
    $pending_tasks = Task::where('status', 'pending')->count();
    $cancelled_tasks = Task::where('status', 'cancelled')->count();
    $active_tasks = Task::where('status', 'in_progress')->count();
    $completed_tasks = Task::where('status', 'completed')->count();
@endphp

<x-app-layout title='Dashboard'>

    <x-header title='Dashboard' />


    @if (auth()->user()->isAdmin())
        <div class="mt-4 gap-2 space-y-2 md:grid md:grid-cols-2 md:space-y-0 lg:grid-cols-4">


            <x-card>
                <x-stat title="Number Of Employees" :value="$number_of_employees" icon="o-user-group" />
            </x-card>

            <x-card>
                <x-stat title="Pending Tasks" :value="$pending_tasks" icon="o-clock" />
            </x-card>

            <x-card>
                <x-stat title="Cancelled Tasks" :value="$cancelled_tasks" icon="o-document" />
            </x-card>

            <x-card>
                <x-stat title="Completed Tasks" :value="$completed_tasks" icon="o-document-check" />
            </x-card>

        </div>
        <div class="mt-5">
            <livewire:leave-stats />
        </div>
        <div class="mt-5">
            <x-event-calender />
        </div>
    @else
        <div class="mt-5">
            <livewire:user-stats />
        </div>

        <div class="mt-5">
            <livewire:leave-stats />
        </div>
        <div class="mt-5">
            <x-event-calender />
        </div>


        <livewire:eprs :user_id="auth()->user()->id" />
        <div class="mt-5">
            <x-attendence-details :user_id="auth()->user()->id" />
        </div>
    @endif



</x-app-layout>
