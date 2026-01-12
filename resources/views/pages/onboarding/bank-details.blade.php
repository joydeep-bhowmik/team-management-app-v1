<?php

use Mary\Traits\Toast;
use Livewire\Volt\Component;

new class extends Component {
    use Toast;

    public $account_holder_name;
    public $ifsc_code;
    public $bank_name;
    public $account_number;
    public $confirmation_account_number; // New property

    function mount()
    {
        $user = auth()->user();

        $this->account_holder_name = $user->bank_details['account_holder_name'] ?? null;
        $this->ifsc_code = $user->bank_details['ifsc_code'] ?? null;
        $this->bank_name = $user->bank_details['bank_name'] ?? null;
        $this->account_number = $user->bank_details['account_number'] ?? null;
    }

    public function save()
    {
        $this->validate([
            'account_holder_name' => 'required|string|max:255',
            'ifsc_code' => 'required|string|size:11',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|numeric|min:10',
            'confirmation_account_number' => 'required|same:account_number', // Confirmation validation
        ]);

        $user = auth()->user();

        $bankDetails = [
            'account_holder_name' => $this->account_holder_name,
            'ifsc_code' => $this->ifsc_code,
            'bank_name' => $this->bank_name,
            'account_number' => $this->account_number,
        ];

        $user->bank_details = $bankDetails;

        if ($user->save()) {
            $this->success('Saved');
            $this->dispatch('redirect-to-next');
        }
    }
};
?>

<x-onboarding-layout title="Bank Details">
    <div>
        @volt('onboarding.bank-details')
            <div>
                <x-card title="Bank Details">

                    <x-slot:menu>
                        <x-button wire:click='save' spinner>Save</x-button>
                    </x-slot:menu>

                    <div class="space-y-3">
                        <x-input wire:model="account_number" label="Account Number" name="account_number" />
                        <x-input wire:model="confirmation_account_number" label="Confirm Account Number"
                            name="confirmation_account_number" /> <!-- Confirmation field -->
                        <x-input wire:model="account_holder_name" label="Account Holder Name" name="account_holder_name" />
                        <x-input wire:model="ifsc_code" label="IFSC Code" name="ifsc_code" />
                        <x-input wire:model="bank_name" label="Bank Name" name="bank_name" />
                    </div>

                </x-card>
            </div>
        @endvolt
    </div>
</x-onboarding-layout>
