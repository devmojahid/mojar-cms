<?php 

/**
 * Contracts/RepeaterFieldContract.php
 */
namespace Juzaweb\CMS\Contracts;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

interface RepeaterFieldContract
{
    /**
     * Get the repeater field configuration
     *
     * @return array
     */
    public function getConfig(): array;

    /**
     * Get the repeater field items
     *
     * @return array
     */
    public function getItems(): array;

    /**
     * Set the repeater field items
     *
     * @param array $items
     * @return void
     */
    public function setItems(array $items): void;

    /**
     * Get the default items
     *
     * @return array
     */
    public function getDefaultItems(): array;

    /**
     * Validate an item's data against the field configuration
     *
     * @param array $itemData
     * @return bool
     */
    public function validateItem(array $itemData): bool;
}