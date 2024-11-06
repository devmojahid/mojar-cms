<?php

namespace Mojar\Backend\Repositories;

use Mojar\CMS\Models\User;
use Mojar\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class UserRepositoryEloquent.
 *
 * @property User $model
 */
class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
