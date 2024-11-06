<?php

namespace Mojar\CMS\Support\Notifications;

use Mojar\CMS\Events\PusherEvent;

class BroadcastNotification extends NotificationAbstract
{
    public function handle()
    {
        event(new PusherEvent($user, $notification));
    }
}
