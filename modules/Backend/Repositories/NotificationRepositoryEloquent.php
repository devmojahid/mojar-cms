<?php

namespace Mojar\Backend\Repositories;

use Mojar\Backend\Models\Notification;
use Mojar\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class NotificationRepositoryRepositoryEloquent.
 *
 * @property Notification $model
 */
class NotificationRepositoryEloquent extends BaseRepositoryEloquent implements NotificationRepository
{
    public function model(): string
    {
        return Notification::class;
    }
}
