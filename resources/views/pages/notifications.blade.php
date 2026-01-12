<?php

use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use App\Notifications\LeaveApproved;
use App\Notifications\LeaveDeclined;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskNotification;
use App\Notifications\NewLeaveApplication;
use App\Notifications\ConversationNotification;
use Illuminate\Notifications\DatabaseNotification;

new class extends Component {
    use WithPagination;

    public string|null $sortBy = 'all';

    protected $listeners = ['notification-received' => '$refresh'];

    function mount()
    {
        $this->sortBy = request('sortBy') ?? 'all';
    }

    function markAsRead($id, $link)
    {
        $notification = DatabaseNotification::find($id);

        $notification->markAsRead();

        $this->dispatch('update-notification-count', count: auth()->user()->unreadNotifications()->count());

        $this->redirect($link, navigate: true);
    }

    function markAllAsread()
    {
        $notifications = auth()->user()->unreadNotifications->markAsRead();

        $this->dispatch('update-notification-count', count: auth()->user()->unreadNotifications()->count());
    }

    public function with()
    {
        $user = auth()->user();

        $notifications = $user
            ->notifications()
            ->when($this->sortBy == 'today', function ($q) {
                $q->whereDate('created_at', Carbon::today());
            })
            ->latest()
            ->paginate();

        return compact('notifications', 'user');
    }
};
?>
<x-app-layout title='Notifications'>
    <x-header title='Notifications'>
        <x-slot:actions>
            <x-push-notification-switch label='' />
        </x-slot:actions>
    </x-header>



    @volt('notification')
        <div>

            {{-- <div class="mx-auto grid place-items-center"> <x-loading wire:loading /></div> --}}
            {{-- wire:loading.class='invisible' --}}

            <x-button :link="route('notifications') . '?sortBy=all'" @class(['btn-primary' => $this->sortBy == 'all'])>All</x-button>

            <x-button :link="route('notifications') . '?sortBy=today'" @class(['btn-primary' => $this->sortBy == 'today'])>Today</x-button>


            @if ($user->unreadNotifications->count())
                <x-button wire:click="markAllAsread" spinner>All read</x-button>
            @endif

            <div class=" mt-5 divide-y">



                @forelse ($notifications as $notification)
                    @if ($notification->type === TaskNotification::class)
                        <x-notification-card
                            wire:click="markAsRead(`{{ $notification->id }}`,`{{ $notification->data['link'] }}`)"
                            :read="!$notification->unread()" icon="o-clipboard" :timeAgo="$notification->created_at->diffForHumans()">
                            {{ $notification->data['from']['name'] }}
                            assigned you a new task
                        </x-notification-card>
                    @endif

                    @if ($notification->type === ConversationNotification::class)
                        <x-notification-card
                            wire:click="markAsRead(`{{ $notification->id }}`,`{{ $notification->data['link'] }}`)"
                            :read="!$notification->unread()" icon="o-chat-bubble-bottom-center" :timeAgo="$notification->created_at->diffForHumans()">
                            {!! $notification->data['title'] !!}
                        </x-notification-card>
                    @endif




                    @if ($notification->type === NewLeaveApplication::class)
                        <x-notification-card
                            wire:click="markAsRead(`{{ $notification->id }}`,`{{ $notification->data['link'] }}`)"
                            :read="!$notification->unread()" icon="o-question-mark-circle" :timeAgo="$notification->created_at->diffForHumans()">
                            {!! $notification->data['from'] !!} applied for a leave application
                        </x-notification-card>
                    @endif


                    @if ($notification->type === LeaveApproved::class)
                        <x-notification-card
                            wire:click="markAsRead(`{{ $notification->id }}`,`{{ $notification->data['link'] }}`)"
                            :read="!$notification->unread()" icon="o-question-mark-circle" :timeAgo="$notification->created_at->diffForHumans()">
                            You leave application is approved
                        </x-notification-card>
                    @endif


                    @if ($notification->type === LeaveDeclined::class)
                        <x-notification-card
                            wire:click="markAsRead(`{{ $notification->id }}`,`{{ $notification->data['link'] }}`)"
                            :read="!$notification->unread()" icon="o-question-mark-circle" :timeAgo="$notification->created_at->diffForHumans()">
                            You leave application is declined
                        </x-notification-card>
                    @endif

                @empty
                    <center class="mt-5">No notification found</center>
                @endforelse



            </div>

            <div class=" mt-5">
                {{ $notifications->links() }}
            </div>
        </div>
    @endvolt
</x-app-layout>
