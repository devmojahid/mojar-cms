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
        $this->items = $this->defaultItems;
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
        $this->items = array_filter($items, [$this, 'validateItem']);
    }

    public function getDefaultItems(): array
    {
        return $this->defaultItems;
    }

    public function validateItem(array $itemData): bool
    {
        foreach ($this->config['fields'] as $field) {
            $name = $field['name'];
            if (!isset($itemData[$name]) && !($field['optional'] ?? false)) {
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
        return array_merge([
            'min_items' => 0,
            'max_items' => null,
            'add_button_text' => trans('cms::app.add_item'),
            'remove_button_text' => trans('cms::app.remove'),
            'sortable' => true,
            'collapsible' => true,
            'confirm_remove' => true,
        ], $config);
    }
}