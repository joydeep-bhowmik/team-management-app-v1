<?php

use App\Models\User;
use Mary\Traits\Toast;
use App\Models\Address;
use Livewire\Volt\Component;

new class extends Component {
    use Toast;
    public $id;
    public $state;
    public $city;
    public $pincode;
    public $address_line_one;
    public $address_line_two;
    public $country = 'India';
    public $type = 'permanent';
    public User $user;
    public bool $disabled = false;
    public $one_address = false;
    public string $dispatchOnSuccess = '';

    function mount(User $user, string $type, string $dispatchOnSuccess = '', bool $disabled = false)
    {
        $this->type = $type;
        $this->user = $user;
        $this->disabled = $disabled;
        $this->dispatchOnSuccess = $dispatchOnSuccess;
        $address = Address::where('user_id', $this->user->id)
            ->where('type', $this->type)
            ->first();

        $address && $this->populateAddress($address);
    }

    private function populateAddress(Address $address)
    {
        $this->id = $address->id;
        $this->state = $address->state;
        $this->city = $address->city;
        $this->pincode = $address->pincode;
        $this->address_line_one = $address->address_line_one;
        $this->address_line_two = $address->address_line_two;
        $this->country = $address->country;
    }

    function copyFromCurrentAddress()
    {
        $current_address = Address::where('user_id', $this->user->id)
            ->where('type', 'current')
            ->first();

        $current_address && $this->populateAddress($current_address);
    }

    function save()
    {
        $this->validate([
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'address_line_one' => 'required|string',
            'address_line_two' => 'nullable|string',
            'country' => 'nullable|string|max:255',
            'type' => 'required|in:current,permanent',
        ]);

        $address =
            Address::where('user_id', $this->user->id)
                ->where('type', $this->type)
                ->first() ?? new Address();

        $address->user_id = $this->user->id;
        $address->type = $this->type;

        // Explicitly assign each field
        $address->state = $this->state;
        $address->city = $this->city;
        $address->pincode = $this->pincode;
        $address->address_line_one = $this->address_line_one;
        $address->address_line_two = $this->address_line_two;
        $address->country = $this->country;

        // Save and handle success feedback
        if ($address->save()) {
            $this->dispatch('current-address-saved');
            $this->success(ucfirst($this->type) . ' Address Saved');
            $this->dispatch($this->dispatchOnSuccess);
        }
    }

    function delete()
    {
        $address = Address::find($this->id);

        if ($address?->delete()) {
            $this->resetExcept('user');
            $this->success(ucfirst($this->type) . ' Address Deleted');
        }
    }
};
?>

<x-card :title="ucfirst($this->type) . ' address'">

    <div class="space-y-3">
        @if ($type == 'permanent')
            <x-button wire:click='copyFromCurrentAddress' icon='o-clipboard' spinner>Copy </x-button>

            @if ($id)
                <x-button wire:click='delete' icon='o-trash' wire:confirm="Are you sure?" spinner class="btn-error">Delete
                </x-button>
            @endif
        @endif

        <x-input label='State' wire:model='state' :disabled="$disabled" />
        <x-input label='City' wire:model='city' :disabled="$disabled" />
        <x-input label='Pincode' wire:model='pincode' :disabled="$disabled" />
        <x-textarea label='Address line one' wire:model='address_line_one' :disabled="$disabled" />
        <x-textarea label='Address line two' wire:model='address_line_two' :disabled="$disabled" />
        <x-select label='Country' wire:model='country' :options="[['id' => 'india', 'name' => 'India']]" :disabled="$disabled" />
    </div>

    <x-slot:menu>
        <x-button wire:click='save' spinner>Save</x-button>
    </x-slot:menu>
</x-card>
