<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Contracts;

interface GlobalDataContract
{
    public function set($key, $value);

    public function get($key, $default = []);

    public function all(): array;
}
