<?php
use App\Models\Note;
use Mary\Traits\Toast;
use Illuminate\Support\Str;
use Livewire\Volt\Component;

new class extends Component {
    use Toast;

    function with()
    {
        $user = auth()->user();

        return compact('user');
    }
};
?>


<div class="mx-auto max-w-7xl space-y-2">
    <x-avatar :image="$user->avatar" :title="$user->name . ' (#' . $user->uniqid . ')'" :subtitle="$user->designation()->first()?->name" class="!w-10" />
    <x-layout :cols="4" class="mt-5">
        <x-card>
            <x-stat title="My Pending Tasks" :value="$user->pendingTasks()?->count()" icon="o-clock" />
        </x-card>

        <x-card>
            <x-stat title="Completed Tasks" :value="$user->completedTasks()?->count()" icon="o-document-check" />
        </x-card>

        <x-card>
            <x-stat title="Assigned Pending Tasks" :value="$user->assignedPendingTasks()?->count()" icon="o-clock" />
        </x-card>

        <x-card>
            <x-stat title="Total Tasks" :value="$user->tasks()?->count()" icon="o-clipboard-document-list" />
        </x-card>
    </x-layout>
</div>
