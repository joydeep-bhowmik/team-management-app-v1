<?php

use App\Models\Epr;
use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    use Toast;
    public string|null $id = null;

    public string|null $user_id = null;

    public string|null $value = null;

    public string|null $month = null;

    public string|null $note = null;

    public bool $showModal = false;

    function mount(string $user_id)
    {
        $this->user_id = $user_id;
    }

    function save()
    {
        $this->validate([
            'value' => 'required|max:10|numeric',
            'month' => 'required',
            'note' => 'nullable',
        ]);

        $epr = Epr::find($this->id) ?? new Epr();

        $epr->value = $this->value;

        $epr->month = $this->month;

        $epr->user_id = $this->user_id;

        $epr->note = $this->note;

        if ($epr->save()) {
            $this->success('Saved');
            $this->reset(['value', 'month']);
            $this->showModal = false;
            $this->dispatch('refresh-eprs');
        }
    }
    #[On('editEpr')]
    function showEditModal(string $id)
    {
        $epr = Epr::find($id);

        $this->id = $epr->id;

        $this->value = $epr->value;

        $this->note = $epr->note;

        $this->month = $epr->month->format('Y-m-d');

        $this->showModal = true;
    }

    function showCreateModal()
    {
        $this->reset(['value', 'month']);
        $this->showModal = true;
    }

    function with()
    {
        $user = User::find($this->user_id);

        return compact('user');
    }
};

?>
<div>
    <x-big-loading-screen wire:loading wire:target='save,showModal,showEditModal,showCreateModal' />


    <x-modal wire:model="showModal" class="backdrop-blur" :title="$id ? 'Edit ' : 'Create '">
        <div class="space-y-5">

            <x-datetime label="Month" wire:model='month' />
            <x-input label="Value" wire:model='value' />
            <x-textarea label="Note" wire:model="note" />
        </div>
        <x-slot:actions>
            <x-button spinner wire:click='save'>Save</x-button>
        </x-slot:actions>
    </x-modal>

    <x-card title="Epr" subtitle="Employee Performance Rating" class="mt-5">

        @if (auth()->user()->isAdmin())
            <x-slot:menu>
                <x-button wire:click='showCreateModal' icon='o-plus' spinner />
            </x-slot:menu>
        @endif
        <livewire:datatables.EprTable :user_id="$user->id" />
    </x-card>

</div>
