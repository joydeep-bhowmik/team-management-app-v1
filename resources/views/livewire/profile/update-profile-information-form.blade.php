<?php

use App\Models\User;
use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

new class extends Component {
    use WithFileUploads, Toast;
    public string $name = '';
    public string $email = '';
    public string $phone_number = '';
    public string $whatsapp_number = '';
    public $avatar;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number ?? '';
        $this->whatsapp_number = $user->whatsapp_number ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:1024'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone_number' => ['required', 'string', 'max:20', Rule::unique(User::class)->ignore($user->id)],
            'whatsapp_number' => ['nullable', 'string', 'max:20', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($this->avatar) {
            $user->deleteMediaCollection('photo');
            $user->addMedia($this->avatar)->toCollection('photo');
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);

        $this->success('Profile Updated');
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
};
?>
<x-card title="Profile Information" subtitle="Update your account's profile information and email address.">



    <form class="mt-6 space-y-6">
        <div>
            <x-file wire:model="avatar" accept="image/png, image/jpeg">

                <x-avatar :image="auth()->user()?->avatar ?? '/empty-user.jpg'" class="!w-24" />
            </x-file>
        </div>
        <div>
            <x-input label="Name" wire:model="name" />
        </div>

        <div>
            <x-input label="Email" wire:model="email" />
            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button wire:click.prevent="sendVerification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input label="Phone Number" wire:model="phone_number" />
        </div>

        <div>
            <x-input label="WhatsApp Number" wire:model="whatsapp_number" />
        </div>

        <x-slot:menu>
            <div class="flex items-center gap-4">
                <x-button spinner wire:click='updateProfileInformation'>{{ __('Save') }}</x-button>

            </div>
        </x-slot:menu>
    </form>
</x-card>
