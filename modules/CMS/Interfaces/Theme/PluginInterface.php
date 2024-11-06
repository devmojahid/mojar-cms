<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/juzacms
 * @author     The Anh Dang
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Mojar\CMS\Interfaces\Theme;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Mojar\CMS\Support\Plugin;

/**
 * @see Plugin
 */
interface PluginInterface extends Arrayable
{
    public function getPath(string $path = ''): string;

    public function getInfo(bool $assoc = false): array|Collection;
}
