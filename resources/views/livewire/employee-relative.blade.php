<?php

use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\EmployeeRelative;
use JoydeepBhowmik\LaravelMediaLibary\Models\Media;

new class extends Component {
    use Toast, WithFileUploads;

    public $id;
    public User $user;
    public $full_name;
    public $relation_type;
    public $phone_number;
    public $address;
    public $identity_proof_document;
    public $title;
    public bool $isNominee = false;
    public string $dispatchOnSuccess = '';

    function mount(User $user, string $dispatchOnSuccess = '', string $title = '', bool $isNominee = false)
    {
        $this->user = $user;
        $this->isNominee = $isNominee;
        $this->title = $title ?? '';
        $this->dispatchOnSuccess = $dispatchOnSuccess;

        $people = $this->getPeople();
        if ($people) {
            $this->fillDetails($people);
        }
    }

    function getPeople()
    {
        return EmployeeRelative::where('user_id', $this->user->id)
            ->where('is_nominee', $this->isNominee)
            ->first();
    }

    function save()
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|digits:10',
            'address' => 'required|string|max:500',
            'relation_type' => 'required|in:spouse,mother,father,guardian',
            'identity_proof_document' => [$this->user?->getFirstMedia(($this->isNominee ? 'nominee' : 'guardian') . '_identity_proof_document') ? 'nullable' : 'required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ]);

        $people = $this->getPeople() ?? new EmployeeRelative();
        $people->name = $this->full_name;
        $people->user_id = $this->user->id;
        $people->phone_number = $this->phone_number;
        $people->relation_type = $this->relation_type;
        $people->is_nominee = $this->isNominee;
        $people->address = $this->address;

        if ($people->save()) {
            if ($this->identity_proof_document) {
                $this->user->deleteMediaCollection(($this->isNominee ? 'nominee' : 'guardian') . '_identity_proof_document');
                $this->user->addMedia($this->identity_proof_document)->toCollection(($this->isNominee ? 'nominee' : 'guardian') . '_identity_proof_document');
            }

            $this->success('Saved');
            $this->dispatch($this->dispatchOnSuccess);
        }
    }

    function delete()
    {
        $people = $this->getPeople();
        if ($people?->delete()) {
            $this->success('Deleted');
        }
    }

    function fillDetails(EmployeeRelative $people)
    {
        $this->id = $people->id;
        $this->full_name = $people->name;
        $this->relation_type = $people->relation_type;
        $this->phone_number = $people->phone_number;
        $this->address = $people->address;
        $this->identity_proof_document = $people->identity_proof;
    }

    function with()
    {
        return ['people' => $this->getPeople()];
    }
};

?>

<x-card :$title>


    <x-big-loading-screen wire:loading wire:target='identity_proof_document' />

    @if ($people)
        <x-button icon='o-trash' wire:confirm="Are you sure ?" class="btn-error" wire:click='delete' spinner />
    @endif


    <div class="space-y-5">
        <x-input wire:model='full_name' label='Full name' />

        <x-input wire:model='phone_number' label='Phone number' />

        <x-textarea wire:model='address' label='Address' />

        <x-select label='Relation type' wire:model='relation_type' :options="[
            ['id' => '', 'name' => 'Select'],
            ['id' => 'mother', 'name' => 'Mother'],
            ['id' => 'father', 'name' => 'Father'],
            ['id' => 'spouse', 'name' => 'Spouse'],
            ['id' => 'guardian', 'name' => 'Guardian'],
        ]" />




        <div>
            <x-file wire:model='identity_proof_document' label='Identity proof document' />

            @php
                $identity_proof_document = $user?->getFirstMedia(
                    ($isNominee ? 'nominee' : 'guardian') . '_identity_proof_document',
                );
            @endphp
            @if ($identity_proof_document)
                <x-button class="mt-1" icon='o-document' :link='$identity_proof_document->getUrl()' :label='$identity_proof_document?->original_file_name' />
            @endif
        </div>
    </div>
    <x-slot:menu>
        <x-button wire:click='save' spinner>Save</x-button>
    </x-slot:menu>
</x-card>
