<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LeaveApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

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
            title: 'Your leave application was approved',
            body: '',
        )))
            ->custom([
                'webpush' => [
                    'notification' => [
                        'color'        => '#0A0A0A',
                        'sound'        => 'default',
                        'click_action' => route('notifications'),
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
                        'click_action' => route('notifications'),
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
            'link' => route('leaveApplications.all'),
        ];
    }
}
