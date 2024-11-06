<?php

namespace Mojar\Backend\Policies;

use Mojar\CMS\Abstracts\ResourcePolicy;

class UserPolicy extends ResourcePolicy
{
    protected string $resourceType = 'users';
}
