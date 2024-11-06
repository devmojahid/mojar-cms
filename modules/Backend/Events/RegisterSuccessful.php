<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\Backend\Events;

use Mojar\CMS\Models\User;

class RegisterSuccessful
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
