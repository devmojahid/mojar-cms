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

use Mojar\Backend\Models\MediaFile;

class MediaWasUploaded
{
    public $mediaFile;

    public function __construct(MediaFile $mediaFile)
    {
        $this->mediaFile = $mediaFile;
    }
}
