<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://github.com/mojar/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Support;

class Breadcrumb
{
    public static function render($name, $items = [])
    {
        return view(static::getNameView($name), [
            'items' => $items,
        ]);
    }

    public static function getNameView($name)
    {
        return apply_filters('breadcrumb.render', [
            'admin' => 'cms::items.breadcrumb',
        ])[$name];
    }
}
