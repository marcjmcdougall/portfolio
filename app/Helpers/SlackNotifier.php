<?php

namespace App\Helpers;

use App\Notifications\ApplicationError;
use Illuminate\Support\Facades\Notification;

class SlackNotifier
{
    public static function error($exception, $url = null)
    {
        Notification::route('slack', '#' . config('services.slack.notifications.channel'))
            ->notify(new ApplicationError($exception, $url));
    }
}