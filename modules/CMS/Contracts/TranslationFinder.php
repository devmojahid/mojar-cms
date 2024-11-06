<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\CMS\Contracts;

/**
 * @see \Mojar\CMS\Support\Translations\TranslationFinder
 */
interface TranslationFinder
{
    public function find(string $path, string $locale = 'en'): array;
}
