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

use Juzaweb\Backend\Models\MediaFile;

class UploadFileSuccess
{
    public function __construct(public MediaFile $file) {}
}
