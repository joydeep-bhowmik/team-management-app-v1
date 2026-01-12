@props(['onlybell' => true])
<?php

use Mary\Traits\Toast;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    use Toast;
    public $count = 0;

    public bool $onlybell = false;

    function mount($onlybell)
    {
        $this->onlybell = $onlybell;
        $this->count = auth()->user()->unreadNotifications()->count();
    }
    #[On('notification-received')]
    function refreshCount()
    {
        $this->updateNotificationCount();
        $this->info('New Notification Recieved');
        $this->dispatch('update-notification-count', count: auth()->user()->unreadNotifications()->count());
    }
    #[On('update-notification-count')]
    function updateNotificationCount()
    {
        $this->count = auth()->user()->unreadNotifications()->count();
    }
};
?>

@volt('notitication-icon')
    <div>
        @if ($onlybell)
            <x-button icon="o-bell" class="btn-circle relative bg-transparent border-0 shadow-none" :link="route('notifications')">
                @if ($count)
                    <x-badge :value="$count" class="badge-error absolute -right-2 -top-2" />
                @endif

            </x-button>
        @else
            <x-menu-item title="Notifications" icon="o-bell" :badge="$count ?? null" :link="route('notifications')" />
        @endif
    </div>
@endvolt
