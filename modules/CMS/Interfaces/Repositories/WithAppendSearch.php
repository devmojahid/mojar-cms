<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Juzaweb\CMS\Interfaces\Repositories;

/**
 * @deprecated
 */
interface WithAppendSearch
{
    public function appendCustomSearch($builder, $keyword, $input);
}
