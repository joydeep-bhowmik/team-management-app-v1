<?php

use App\Models\Address;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public $same_as_current = false;

    function with()
    {
        $current_address = Address::where('user_id', auth()->user()->id)
            ->where('type', 'current')
            ->first();

        return compact('current_address');
    }

    #[On('current-address-saved')]
    function refreshComponent()
    {
        $this->redirect(route('onboarding.address'), navigate: true);
    }
};
?>

<x-onboarding-layout title="address">
    @volt('manage-address')
        <div wire:loading.class='opacity-55' x-data="{
            same_as_current: false
        }">
            @php
                $user = auth()->user();
            @endphp
            <div class="space-y-5">

                <livewire:manage-address type='current' :$user wire:key='current_address' />

                @if ($current_address)
                    <livewire:manage-address type='permanent' :$user :disabled='$same_as_current' wire:key='permanent_address'
                        dispatchOnSuccess='redirect-to-next' />
                @endif
            </div>
        </div>
    @endvolt

</x-onboarding-layout>
