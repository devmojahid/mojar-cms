<?php

namespace Mojar\CMS\Providers;

use Mojar\CMS\Console\Commands\SendNotifyCommand;
use Mojar\CMS\Support\Notification;
use Mojar\CMS\Support\ServiceProvider;
use Mojar\CMS\Support\Notifications\DatabaseNotification;
use Mojar\CMS\Support\Notifications\EmailNotification;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Notification::register('database', DatabaseNotification::class);
        Notification::register('mail', EmailNotification::class);
    }

    public function register()
    {
        $this->commands(
            [
                SendNotifyCommand::class,
            ]
        );
    }
}
