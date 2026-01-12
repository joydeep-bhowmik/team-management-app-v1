<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $key = '';

    function with()
    {
        $users = User::where('name', 'like', '%' . $this->key . '%')
            ->orderBy('name')
            ->paginate(12);

        return compact('users');
    }
};
?>

<x-app-layout title="People">
    <x-header title="People" subtitle="Here's all the people " />
    @volt('people')
        <div>


            <x-input placeholder="Search" icon="o-magnifying-glass" wire:model.live.debounce.500ms="key" />
            <div wire:loading class="w-full">
                <div class="grid place-items-center h-80 w-full">
                    <x-loading />
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 mt-5" wire:loading.remove>
                @foreach ($users as $user)
                    <div
                        class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                        <div class="flex flex-col items-center py-8 px-5">
                            <x-avatar :image="$user->avatar" class="!w-24" />
                            <h5 class="mb-1 text-xl font-medium text-gray-900 text-center dark:text-white">
                                {{ $user->name }}</h5>
                            <div class="text-sm"><i> #{{ $user->uniqid }}</i></div>
                            <span
                                class="text-sm text-gray-500 dark:text-gray-400 capitalize text-center">{{ $user->designation()->first()?->name }}</span>
                            <div class="flex mt-4 md:mt-6 gap-2">

                                @if (auth()->user()->canAssignTaskTo($user))
                                    <x-button class="btn-primary" :link="route('tasks.create') . '?assignee=' . $user->id">Add task</x-button>
@endif
                               


                            <x-button :link="route('employees.view',$user->id)">View</x-button>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


            <div class="mt-5">
                {{ $users->links() }}
            </div>

        </div>
    @endvolt
</x-app-layout>
