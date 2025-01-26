<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\Network\Observers;

use Juzaweb\Network\Models\Site;

class SiteModelObserver
{
    /**
     * Handle the Model "deleted" event.
     *
     * @param Site $model
     * @return void
     * @throws \Exception
     */
    public function updated(Site $model): void
    {
        cache()->pull(md5($model->getFullDomain()));
    }

    /**
     * Handle the Model "deleted" event.
     *
     * @param Site $model
     * @return void
     * @throws \Exception
     */
    public function deleted(Site $model): void
    {
        cache()->pull(md5($model->getFullDomain()));
    }
}
