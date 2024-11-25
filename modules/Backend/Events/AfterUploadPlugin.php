<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Backend\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AfterUploadPlugin
{
    use Dispatchable;

    use SerializesModels;

    protected array $plugin;

    public function __construct(array $plugin)
    {
        $this->plugin = $plugin;
    }
}
