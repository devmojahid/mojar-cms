<?php

/**
 * Support/Html/RepeaterField.php
 */

namespace Juzaweb\CMS\Support\Html;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Juzaweb\CMS\Contracts\RepeaterFieldContract;

class RepeaterField implements RepeaterFieldContract
{
    protected array $config;
    protected array $items = [];
    protected array $defaultItems = [];

    /**
     * Create a new repeater field instance
     *
     * @param array $config Field configuration
     */
    public function __construct(array $config)
    {
        $this->config = $this->normalizeConfig($config);
        $this->defaultItems = $config['default'] ?? [];
        $this->items = $this->normalizeItems($config['value'] ?? $this->defaultItems);
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $this->normalizeItems($items);
    }

    public function getDefaultItems(): array
    {
        return $this->defaultItems;
    }

    public function validateItem(array $itemData): bool
    {
        if (empty($itemData)) {
            return false;
        }

        foreach ($this->config['fields'] as $field) {
            $name = $field['name'];
            
            // Skip optional fields
            if (isset($field['optional']) && $field['optional']) {
                continue;
            }
            
            // For required fields, ensure they exist and are not null/empty string
            if (!isset($itemData[$name]) || 
                (is_string($itemData[$name]) && trim($itemData[$name]) === '')) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * Normalize the field configuration
     *
     * @param array $config
     * @return array
     */
    protected function normalizeConfig(array $config): array
    {
        $defaultConfig = [
            'min_items' => 0,
            'max_items' => null,
            'add_button_text' => trans('cms::app.add_item', ['label' => $config['label'] ?? '']),
            'remove_button_text' => trans('cms::app.remove'),
            'sortable' => true,
            'collapsible' => true,
            'confirm_remove' => true,
            'fields' => [],
            'value' => [],
        ];

        return array_merge($defaultConfig, $config);
    }

    /**
     * Normalize and filter items
     *
     * @param array $items
     * @return array
     */
    protected function normalizeItems(array $items): array
    {
        // Handle JSON string values that might come from the database
        if (count($items) === 1 && is_string(reset($items))) {
            $jsonValue = reset($items);
            try {
                $decodedItems = json_decode($jsonValue, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decodedItems)) {
                    $items = $decodedItems;
                }
            } catch (\Exception $e) {
                // If decoding fails, keep original items
            }
        }

        // If it's not a multidimensional array, but should be
        if (!empty($items) && !is_array(reset($items))) {
            // If it appears to be a single item, wrap it
            $items = [$items];
        }

        // Filter out invalid items
        return array_filter($items, [$this, 'validateItem']);
    }
}