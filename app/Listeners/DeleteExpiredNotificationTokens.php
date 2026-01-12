<?php

namespace App\Listeners;

use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Support\Arr;

class DeleteExpiredNotificationTokens
{
    /**
     * Handle the event.
     */
    public function handle(NotificationFailed $event): void
    {
        $report = Arr::get($event->data, 'report');

        // Ensure the target exists and is valid
        $target = $report ? $report->target() : null;

        if ($target) {
            // Assuming 'target' is a string or object containing the push token
            $pushToken = $target->value() ?? null;

            if ($pushToken) {
                // Delete the expired device token
                $event->notifiable->getDeviceTokens()
                    ->where('token', $pushToken)  // Ensure this matches the column name for the token
                    ->delete();
            }
        }
    }
}
