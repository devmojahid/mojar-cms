<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\Backend\Events;

use Mojar\Backend\Models\MediaFolder;

class AddFolderSuccess
{
    public MediaFolder $folder;

    public function __construct(MediaFolder $folder)
    {
        $this->folder = $folder;
    }
}
