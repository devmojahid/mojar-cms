<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\Backend\Events;

use Juzaweb\CMS\Models\User;

class RegisterSuccessful
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
