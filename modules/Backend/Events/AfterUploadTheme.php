<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Backend\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AfterUploadTheme
{
    use Dispatchable;
    use SerializesModels;

    protected array $theme;

    public function __construct(array $theme)
    {
        $this->theme = $theme;
    }
}
