<?php

use App\Models\DeviceToken;
use Livewire\Volt\Component;

new class extends Component {
    public string $deviceToken;

    function updateDeviceToken()
    {
        $deviceToken = DeviceToken::updateOrCreate(['token' => $this->deviceToken, 'user_id' => auth()->user()->id]);
    }

    function checkIfDeviceTokenExists(string $deviceToken)
    {
        return DeviceToken::where('token', $deviceToken)->first() ? true : false;
    }

    public function updated($property, $value)
    {
        if ($property === 'deviceToken') {
            if ($this->checkIfDeviceTokenExists($value)) {
                $this->dispatch('push-notification-status', value: false);
            } else {
                $this->dispatch('push-notification-status', value: true);
            }
            // $this->updateDeviceToken();
        }
    }
};

?>
@volt('x-check-and-update-device-token')
    <div x-data="firebaseHandler()">


        <input type="hidden" wire:model.live="deviceToken" x-ref="token" />
    </div>
@endvolt
