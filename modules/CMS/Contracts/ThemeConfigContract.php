<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/
 * @license    GNU V2
 */

namespace Mojar\CMS\Contracts;

use Illuminate\Database\Eloquent\Model;
use Mojar\CMS\Models\ThemeConfig as ConfigModel;

interface ThemeConfigContract
{
    public function getConfig(string $key, string|array $default = null): null|string|array;

    public function setConfig(string $key, string|array $value = null): Model|ConfigModel;

    public function getConfigs(array $keys, string|array $default = null): array;
}
