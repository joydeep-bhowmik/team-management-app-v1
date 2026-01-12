<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form>
        <!-- Email Address -->
        <div>
            <x-input wire:model="form.email" :label="__('Email')" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-password wire:model="form.password" right :label="__('Password')" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <x-checkbox wire:model='form.remember' label='Remember me' />
        </div>

        <div class="flex items-center justify-end mt-4 gap-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('register') }}" wire:navigate>
                {{ __('Not registered?') }}
            </a>

            <x-button wire:click='login' class="ms-3" spinner>
                {{ __('Log in') }}
            </x-button>
        </div>
    </form>
</div>
