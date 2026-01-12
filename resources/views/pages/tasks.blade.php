<x-app-layout title="Tasks">
    <x-header title="Tasks" saparator />

    @php
        $user = auth()->user();
        $canViewAllTasks = $user->isAdmin() || $user->hasDesignation('Operation Manager');
        $activeTab = request('tab', 'my-tasks');
    @endphp

    <div class="mb-4 flex gap-4">
        <a href="{{ route('tasks.all', ['tab' => 'my-tasks']) }}"
            class="{{ $activeTab === 'my-tasks' ? 'font-bold underline' : '' }}">
            My Tasks
        </a>

        @if ($canViewAllTasks)
            <a href="{{ route('tasks.all', ['tab' => 'all-tasks']) }}"
                class="{{ $activeTab === 'all-tasks' ? 'font-bold underline' : '' }}">
                All Tasks
            </a>
        @endif
    </div>

    <x-card>
        @if ($activeTab === 'all-tasks' && $canViewAllTasks)
            <livewire:datatables.TaskTable />
        @else
            <livewire:datatables.EmployeeTaskTable :employee_id="$user->id" />
        @endif
    </x-card>
</x-app-layout>
