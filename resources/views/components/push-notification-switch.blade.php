<?php

use App\Models\DeviceToken;
use Livewire\Volt\Component;

new class extends Component {
    public string $deviceToken;
    public $permission = false;

    function saveDeviceToken(bool $state)
    {
        if ($state) {
            $deviceToken = DeviceToken::where('token', $this->deviceToken)->first();

            $deviceToken = $deviceToken ? $deviceToken : new DeviceToken();

            $deviceToken->user_id = auth()->user()->id;

            $deviceToken->token = $this->deviceToken;

            if ($deviceToken->save()) {
                $this->dispatch('push-notification-status', value: true);
                $this->permission = true;
            }
        } else {
            $deviceToken = DeviceToken::where('token', $this->deviceToken)->first();

            $deviceToken->delete();

            $this->permission = false;
        }
    }

    function checkPermission()
    {
        $user = auth()->user();

        $deviceToken = DeviceToken::where('token', $this->deviceToken)->first();

        if ($deviceToken) {
            $this->permission = true;
        }
    }

    public function updated($property, $value)
    {
        if ($property === 'deviceToken') {
            $this->checkPermission();
        }
        if ($property === 'permission') {
            $this->saveDeviceToken($value ? true : false);
        }
    }
};
?>
<div {{ $attributes }}>
    @volt('save-device-token')
        <div x-data="firebaseHandler()" class="p-4  rounded">
            @if ($deviceToken)
                <x-toggle wire:model.live="permission" wire:loading.disabled />
            @else
                <x-loading />
            @endif

            <input type="hidden" wire:model.live="deviceToken" x-ref="token" />

        </div>
    @endvolt

</div>
