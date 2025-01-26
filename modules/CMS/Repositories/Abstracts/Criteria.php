<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    GNU General Public License v2.0
 */

namespace Juzaweb\CMS\Repositories\Abstracts;

use Juzaweb\CMS\Repositories\Contracts\RepositoryInterface;

abstract class Criteria
{
    public static function make(...$params): static
    {
        return new static(...$params);
    }

    abstract public function apply($model, RepositoryInterface $repository);
}
