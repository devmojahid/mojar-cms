<?php

namespace Mojar\CMS\Support\Notifications;

abstract class NotificationAbstract
{
    protected $notification;
    protected $users;
    /**
     * @param \Mojar\Backend\Models\ManualNotification $notification
     * */
    public function __construct($notification)
    {
        $this->notification = $notification;
        $this->users = explode(',', $this->notification->users);
    }

    abstract public function handle();
}
