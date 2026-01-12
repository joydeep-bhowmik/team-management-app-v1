<?php
use Mary\Traits\Toast;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use App\Models\UserDesignation;
use function Livewire\Volt\{state, mount, with};

new class extends Component {
    use Toast;
    public $id;

    public $name;

    public $SL;

    public $CL;

    public $EL;

    public array $selectedAssigneeDesignations = [];

    function mount()
    {
        $id = request('id');

        if (!$id) {
            return;
        }

        $designation = UserDesignation::find($this->id);

        if ($id && !$designation) {
            return abort(404);
        }

        if ($designation) {
            $this->selectedAssigneeDesignations = $designation->assignableDesignations->pluck('id')->toArray();
        }

        $this->id = $id;

        $this->name = $designation->name;

        $this->SL = $designation->SL;

        $this->CL = $designation->CL;

        $this->EL = $designation->EL;
    }

    function save()
    {
        $this->validate([
            'name' => ['required', 'unique:user_designations,name,' . $this->id],
            'SL' => ['required', 'integer'],
            'EL' => ['required', 'integer'],
            'CL' => ['required', 'integer'],
        ]);

        $designation = $this->id ? UserDesignation::find($this->id) : new UserDesignation();
        $designation->name = $this->name;

        $designation->SL = $this->SL;
        $designation->CL = $this->CL;
        $designation->EL = $this->EL;

        if ($designation->save()) {
            $designation->assignableDesignations()->sync($this->selectedAssigneeDesignations);

            $this->success('Saved Successfully');

            !$this->id && $this->redirect(route('designations.edit', $designation->id), navigate: true);
        }
    }
    #[On('deleteDesignation')]
    function delete()
    {
        $designation = UserDesignation::find($this->id);

        if ($designation && $designation->delete()) {
            $this->redirect(route('designations'), navigate: true);

            $this->success('Deleted');
        }
    }

    function with()
    {
        $allDesignations = UserDesignation::all();
        return compact('allDesignations');
    }
};
?>

<x-app-layout>

    @volt('save-designation')
        <div>
            <x-slot:title>{{ ($id ? 'Edit ' : ' Create') . ' designation' }}</x-slot:title>
            <x-layout :title="($id ? 'Edit ' : ' Create') . ' designation'">



                <x-slot name="action">
                    @if ($id)
                        <x-button class="!bg-red-500 text-white" x-data
                            @click="$dispatch('confirm',{subtitle:`This action can't be undone`,eventToEmit:`deleteDesignation`})">Delete</x-button>
                    @endif

                    <x-button wire:click='save' spinner>Save</x-button>
                </x-slot>

                <x-card class="space-y-5">
                    <x-input wire:model='name' label="Designation" />

                    @if ($allDesignations && count($allDesignations))
                        <x-choices label="Can Set Task for" wire:model="selectedAssigneeDesignations" :options="$allDesignations" />
                    @endif

                    <x-input wire:model="SL" label="SL" />
                    <x-input wire:model="CL" label="CL" />
                    <x-input wire:model="EL" label="EL" />


                </x-card>

            </x-layout>
        </div>
    @endvolt
</x-app-layout>
