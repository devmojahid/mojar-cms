<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\CMS\Contracts;


interface RepeaterItem
{
     /**
     * Get the fields configuration for this item
     *
     * @return array
     */
    public function getFields(): array;

    /**
     * Get the values for this item's fields
     *
     * @return array
     */
    public function getValues(): array;

    /**
     * Set values for this item's fields
     *
     * @param array $values
     * @return void
     */
    public function setValues(array $values): void;
}
