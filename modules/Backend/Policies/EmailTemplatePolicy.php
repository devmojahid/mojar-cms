<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\Backend\Policies;

use Mojar\CMS\Abstracts\ResourcePolicy;

class EmailTemplatePolicy extends ResourcePolicy
{
    protected string $resourceType = 'email_templates';
}
