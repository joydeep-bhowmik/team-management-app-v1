<?php
namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class TaskNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Task $task, public string $message = '')
    {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class, 'database'];
    }

    public function toFcm($notifiable): FcmMessage
    {
        return (new FcmMessage(notification: new FcmNotification(
            title: 'New task from ' . $this->task->assigner()->first()?->name,
            body: '',
        )))
            ->data(['click_action' => route('tasks.view', $this->task), 'badge' => $this->task->assigner()->first()?->avatar])
            ->custom([
                'webpush' => [
                    'notification' => [
                        'color'        => '#0A0A0A',
                        'sound'        => 'default',
                        'click_action' => route('tasks.view', $this->task),
                    ],
                    'fcm_options'  => [
                        'link'            => route('notifications'), // This is critical for web redirection
                        'analytics_label' => 'analytics',
                    ],
                ],
                'android' => [
                    'notification' => [
                        'color'        => '#0A0A0A',
                        'sound'        => 'default',
                        'click_action' => route('tasks.view', $this->task),
                    ],
                    'fcm_options'  => [
                        'analytics_label' => 'analytics',
                    ],
                ],
                'apns'    => [
                    'payload'     => [
                        'aps' => [
                            'sound' => 'default',
                        ],
                    ],
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'from' => $this->task->assigner()->first(),
            'link' => route('tasks.view', $this->task),
        ];
    }
}
