<?php

use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use Toast, WithFileUploads;

    public $phone_number;
    public $whatsapp_number;
    public $emergency_phone_number;
    public $date_of_birth;
    public $photo;
    public $gender;
    public $blood_group; // Add blood group

    function mount()
    {
        $user = auth()->user();

        $this->phone_number = $user->phone_number;
        $this->whatsapp_number = $user->whatsapp_number;
        $this->emergency_phone_number = $user->emergency_phone_number;
        $this->date_of_birth = $user->date_of_birth;
        $this->gender = $user->gender;
        $this->blood_group = $user->blood_group; // Fetch blood group
    }

    function save()
    {
        $user = auth()->user();

        $this->validate([
            'photo' => [$user->getFirstMediaUrl('photo') ? 'nullable' : 'required', 'image', 'max:1024'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,15'],
            'whatsapp_number' => ['required', 'numeric', 'digits_between:10,15'],
            'gender' => ['required', 'in:male,female,other'],
            'emergency_phone_number' => ['required', 'numeric', 'digits_between:10,15', 'different:phone_number'],
            'date_of_birth' => ['required', 'date', 'before:today', 'after:1900-01-01'],
            'blood_group' => ['required', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-'], // Validation for blood group
        ]);

        if ($this->photo) {
            $user->deleteMediaCollection('photo');
            $user->addMedia($this->photo)->toCollection('photo');
        }

        $user->phone_number = $this->phone_number;
        $user->whatsapp_number = $this->whatsapp_number;
        $user->emergency_phone_number = $this->emergency_phone_number;
        $user->date_of_birth = $this->date_of_birth;
        $user->gender = $this->gender;
        $user->blood_group = $this->blood_group; // Save blood group

        if ($user->save()) {
            $this->success('Saved');
            $this->dispatch('redirect-to-next');
        }
    }

    function with()
    {
        $user = auth()->user();
        return compact('user');
    }
};

?>



<x-onboarding-layout title="Basic Details">

    @volt('onboarding.basic')
        <div>
            <x-card title="Basics">
                <div class="space-y-3">

                    <x-file wire:model="photo" label='Photo' accept="image/png, image/jpeg">
                        <img src="{{ $user?->photo ?? '/storage/uploads/empty-user.jpg' }}" class="h-40 rounded-lg" />
                    </x-file>

                    <x-radio label="Gender" :options="[
                        ['id' => 'male', 'name' => 'Male'],
                        ['id' => 'female', 'name' => 'Female'],
                        ['id' => 'other', 'name' => 'Other'],
                    ]" wire:model="gender" />

                    <x-input wire:model="phone_number" label="Phone Number" />
                    <x-input wire:model="whatsapp_number" label="WhatsApp Number" />
                    <x-input wire:model="emergency_phone_number" label="Emergency Phone Number" />
                    <x-input type='date' wire:model="date_of_birth" label="Date of Birth" icon="o-calendar" right />
                    <x-input wire:model="blood_group" label="Blood Group"
                        placeholder="Enter your blood group (e.g., A+, O-)" />

                </div>
                <x-slot:menu>
                    <x-button wire:click='save' spinner>save</x-button>
                </x-slot:menu>
            </x-card>



        </div>
    @endvolt

</x-onboarding-layout>
