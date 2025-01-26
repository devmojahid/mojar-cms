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

use Juzaweb\Backend\Models\MediaFolder;

class AddFolderSuccess
{
    public MediaFolder $folder;

    public function __construct(MediaFolder $folder)
    {
        $this->folder = $folder;
    }
}
