<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://mojar.com/cms
 * @license    MIT
 */

namespace Juzaweb\CMS\Support\Collections;

use Illuminate\Support\Collection;

interface XMLCollectionInterface
{
    public function getCollection($filePath): Collection;
}
