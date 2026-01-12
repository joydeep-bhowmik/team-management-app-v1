<?php

use App\Models\Event;
use Mary\Traits\Toast;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use function Livewire\Volt\{state, mount, with};

new class extends Component {
    use Toast;
    public $id;
    public $name;
    public $date;
    public $description;
    public bool $repeat = false; // Default value for repeat

    function mount()
    {
        $id = request('id');

        if ($id && ($event = Event::find($id))) {
            // Populate fields if editing
            $this->id = $event->id;
            $this->name = $event->name;
            $this->date = $event->date->format('Y-m-d'); // Format for datetime input
            $this->description = $event->description;
            $this->repeat = $event->repeat;
        }
    }

    function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'repeat' => ['boolean'],
        ]);

        $event = $this->id ? Event::find($this->id) : new Event();
        $event->name = $this->name;
        $event->date = $this->date;
        $event->description = $this->description;
        $event->repeat = $this->repeat;

        if ($event->save()) {
            $this->success('Event saved successfully!');

            if (!$this->id) {
                $this->redirect(route('events.edit', $event->id), navigate: true);
            }
        } else {
            $this->error('Failed to save the event. Please try again.');
        }
    }

    #[On('deleteEvent')]
    function delete()
    {
        $event = Event::find($this->id);

        if ($event && $event->delete()) {
            $this->success('Event deleted successfully!');
            $this->redirect(route('events.all'), navigate: true);
        } else {
            $this->error('Failed to delete the event. Please try again.');
        }
    }
};

?>
<x-app-layout>
    @volt('save-events')
        <div class="space-y-5">
            <x-slot:title>{{ $id ? 'Edit Event' : 'Create Event' }}</x-slot:title>
            <x-layout :title="$id ? 'Edit Event' : 'Create Event'">
                <x-slot name="action">
                    @if ($id)
                        <x-button class="!bg-red-500 text-white" x-data
                            @click="$dispatch('confirm', { subtitle: 'This action cannot be undone', eventToEmit: 'deleteEvent' })">
                            Delete
                        </x-button>
                    @endif

                    <x-button wire:click="save" spinner>Save</x-button>
                </x-slot>

                <x-card>
                    <div class="space-y-5">
                        <x-input label="Name" wire:model="name" />
                        <x-datetime label="Date" wire:model="date" />
                        <x-textarea label="Description" wire:model="description" />
                        <x-checkbox label="Repeat every year" wire:model="repeat" />
                    </div>
                </x-card>
            </x-layout>
        </div>
    @endvolt
</x-app-layout>
