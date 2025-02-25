<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait UseDescription
{
    public static function bootUseDescription(): void
    {
        static::saving(
            function ($model) {
                if (Schema::hasColumns($model->getTable(), ['description'])) {
                    $model->description = seo_string($model->content, 190);
                }
            }
        );
    }

    public function getDescription($words = 24)
    {
        return apply_filters(
            $this->type . '.get_description',
            Str::words($this->description, $words),
            $words
        );
    }
}
