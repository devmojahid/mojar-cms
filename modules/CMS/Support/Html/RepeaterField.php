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
        
        // Normalize the value from config
        $rawValue = $config['value'] ?? $this->defaultItems;
        $this->items = $this->normalizeItems($rawValue);
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
     * @param mixed $items
     * @return array
     */
    protected function normalizeItems($items): array
    {
        // Handle non-array values
        if (!is_array($items)) {
            // If it's a JSON string, decode it
            if (is_string($items)) {
                try {
                    $decoded = json_decode($items, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $items = $decoded;
                    } else {
                        // If it's not valid JSON, return empty array
                        return [];
                    }
                } catch (\Exception $e) {
                    // If decoding fails, return empty array
                    return [];
                }
            } else {
                // For any other non-array value, return empty array
                return [];
            }
        }
        
        // If items is empty, return it as is
        if (empty($items)) {
            return [];
        }
        
        // Check if this is a multi-dimensional array or a single item
        $firstElement = reset($items);
        if (!is_array($firstElement)) {
            // This appears to be a single item, wrap it in an array
            $items = [$items];
        }
        
        // Ensure each item has all the required fields
        $processedItems = [];
        foreach ($items as $item) {
            // Skip empty or invalid items
            if (empty($item) || !is_array($item)) {
                continue;
            }
            
            // Only add items that pass validation
            if ($this->validateItem($item)) {
                $processedItems[] = $item;
            }
        }
        
        return $processedItems;
    }
}