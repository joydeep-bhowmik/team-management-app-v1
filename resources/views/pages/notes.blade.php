<?php

use App\Models\Note;
use Mary\Traits\Toast;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    use Toast;

    public $id;

    public $title;

    public $description;

    public bool $showModal = false;

    public bool $showViewNoteModal = true;

    function saveNote()
    {
        $this->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);

        $user = auth()->user();

        $user->saveNote(title: $this->title, description: $this->description, id: $this->id) && $this->success('Note Saved');

        $this->closeNoteModal();
    }
    #[On('deleteNote')]
    function deleteNote(string $id)
    {
        $note = Note::find($id);

        $note->delete() && $this->success('Note Deleted');
    }

    function editNote(string $id)
    {
        $note = Note::find($id);

        $this->title = $note->title;

        $this->description = $note->description;

        $this->id = $id;

        $this->openNoteModal(reset: false);
    }

    function openNoteModal(bool $reset = true)
    {
        $reset && $this->reset(['id', 'title', 'description']);
        $this->showModal = true;
    }

    function closeNoteModal()
    {
        $this->reset(['id', 'title', 'description']);
        $this->showModal = false;
    }

    function with()
    {
        $notes = auth()->user()->getNotes();

        return compact('notes');
    }
};
?>

<x-app-layout title="My notes">



    @volt('notes')
        <div>
            <x-header title="My notes" subtitle="Save your notes here">
                <x-slot:actions>
                    <x-button icon="o-plus" class="btn-primary" wire:click='openNoteModal' spinner>Create</x-button>
                </x-slot:actions>
            </x-header>
            <x-modal :title="$id ? 'Edit' : 'Create' . ' note'" wire:model='showModal'>
                <x-input wire:model='title' label='Title' />

                <x-textarea wire:model='description' label='Description' />

                <x-slot:actions>
                    <x-button class="btn-primary" spinner wire:click='saveNote'>Save</x-button>
                </x-slot:actions>
            </x-modal>


            <div class="grid lg:grid-cols-3 grid-cols-1 gap-5">
                @foreach ($notes as $note)
                    <x-card shadow x-data="{ show: false }" :progress-indicator="'editNote(`' . $note->id . '`)'" separator>

                        <x-slot:title>
                            <div @click='show=true'>{{ $note->title }}</div>
                        </x-slot:title>

                        <div style="display: none" class="inset-0 z-50 fixed  bg-[rgba(0,0,0,0.5)] grid place-items-center"
                            x-show="show">
                            <div @click.outside='show=false'
                                class="prose max-w-lg p-4 w-full  bg-white dark:bg-gray-900 rounded-lg shadow border"
                                x-show="show" x-transition>
                                <x-button icon="o-x-mark" @click='show=false' />
                                <h1 class="mt-3">{{ $note->title }}</h1>


                                <div class="mt-5 max-h-[60vh] overflow-auto">
                                    {{ $note->description }}
                                </div>
                            </div>
                        </div>



                        <div @click='show=true'>
                            {{ Str::limit($note->description, 150, $end = '...') }}
                        </div>

                        <x-slot:menu>
                            <x-dropdown icon='o-ellipsis-horizontal' class="!bg-transparent !border-0 !shadow-none">
                                <x-menu-item title="Edit" wire:click='editNote(`{{ $note->id }}`)' spinner
                                    icon='o-pencil' />
                                <x-menu-item title="Delete" icon="o-trash" wire:confirm='Are you sure?' x-data
                                    @click="$dispatch('confirm',{subtitle:`This action can't be undone`,eventToEmit:`deleteNote`, data : [{{ $note->id }}]})" />
                            </x-dropdown>
                        </x-slot:menu>

                    </x-card>
                @endforeach
            </div>
        </div>
    @endvolt
</x-app-layout>
