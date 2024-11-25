<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\CMS\Contracts;

/**
 * @see \Juzaweb\CMS\Support\GoogleTranslate
 */
interface GoogleTranslate
{
    public function translate(string $source, string $target, string $text): string;

    public function withProxy(string|array $proxy): static;
}
