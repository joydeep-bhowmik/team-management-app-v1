<?php

use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

new class extends Component {
    use Toast;
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');

        $this->success('Password Updated');
    }
}; ?>

<x-card title="Update Password" subtitle='Ensure your account is using a long, random password to stay secure.'>


    <form class="mt-6 space-y-6">
        <div>
            <x-password right label='Current Password' wire:model='current_password' />
        </div>

        <div>
            <x-password right label='New Password' wire:model='password' />

        </div>

        <div>
            <x-password right label='Confirm Password' wire:model='password_confirmation' />

        </div>

        <x-slot:menu>
            <div class="flex items-center gap-4">
                <x-button spinner wire:click='updatePassword' spinner>{{ __('Save') }}</x-button>
            </div>
        </x-slot:menu>
    </form>
</x-card>
