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

use Juzaweb\CMS\Models\Search;

trait PostTypeSearch
{
    public static function bootPostTypeSearch()
    {
        static::saved(function ($model) {
            $model->refresh();

            Search::updateOrCreate([
                'post_type' => $model->getPostType('key'),
                'post_id' => $model->id,
            ], [
                'title' => $model->title,
                'description' => str_words_length($model->description, 100, 250),
                'slug' => $model->slug,
                'status' => $model->status,
            ]);
        });

        static::deleted(function ($model) {
            Search::where([
                'post_type' => $model->getPostType('key'),
                'post_id' => $model->id,
            ])->delete();
        });
    }
}
