<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://mojar.com/cms
 * @license    MIT
 */

namespace Mojar\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use Mojar\CMS\Contracts\JWQueryContract;

/**
 * @method static array posts(string $type, array $options = [])
 * @method static array postTaxonomy($post, $taxonomy, $params)
 * @method static array postTaxonomies($post, $taxonomy, $params)
 * @method static array relatedPosts($post, $taxonomy, $params)
 *
 * @see \Mojar\CMS\Support\JWQuery
 * @see \Mojar\CMS\Traits\Queries\PostQuery
 */
class JWQuery extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return JWQueryContract::class;
    }
}
