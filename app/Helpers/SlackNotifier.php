<?php

namespace App\Helpers;

use App\Notifications\ApplicationError;
use Illuminate\Support\Facades\Notification;

class SlackNotifier
{
    public static function error($message, $context = null)
    {
        Notification::route('slack', '#' . config('services.slack.notifications.channel'))
            ->notify(new ApplicationError(new \Exception($message), $context));
    }
}