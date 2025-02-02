<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Juzaweb\CMS\Support\Html\Traits;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Models\User;

trait InputField
{
    public function text(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_input', $options);
    }

    public function hidden(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_input', $options);
    }

    public function textarea(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_textarea', $options);
    }

    public function select(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_select', $options);
    }

    public function checkbox(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options['value'] = Arr::get($options, 'value', 1);
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_checkbox', $options);
    }

    public function slug(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_slug', $options);
    }

    public function editor(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_ckeditor', $options);
    }

    public function selectPost(string|Model $label, ?string $name, ?array $options = []): View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_select_post', $options);
    }

    public function selectTaxonomy(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_select_taxonomy', $options);
    }

    public function selectResource(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_select_resource', $options);
    }

    public function selectUser(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);
        $value = $options['value'] ?? [];
        $value = !is_array($value) ? [$value] : $value;

        $opts = [];
        if ($value) {
            $opts = User::whereIn('id', $value)
                ->get(['id', 'name'])
                ->mapWithKeys(
                    function ($item) {
                        return [
                            $item->id => $item->name
                        ];
                    }
                )
                ->toArray();
        }

        $options['options'] = $opts;
        $options['value'] = $value;
        return view('cms::components.form_select_user', $options);
    }

    public function image(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_image', $options);
    }

    public function images(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_images', $options);
    }

    public function uploadUrl(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_upload_url', $options);
    }

    public function security(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form_security', $options);
    }

    public function filterPosts(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form.filter_posts', compact('name', 'options'));
    }

    public function customMenu(string|Model $label, ?string $name, ?array $options = []): Factory|View
    {
        $options = $this->mapOptions($label, $name, $options);

        return view('cms::components.form.custom_menu', $options);
    }

    /**
     * Renders a repeater field group.
     */
    public function repeater(string|Model $label, ?string $name, ?array $fields = [], ?array $options = []): Factory|View
    {
        // Map common options (label, name, id, etc.)
        $options = $this->mapOptions($label, $name, $options);
        
        // Save the subfields configuration
        $options['fields'] = $fields;
        
        // Set sensible defaults for repeater options
        $options['min_items'] = $options['min_items'] ?? 0;
        $options['max_items'] = $options['max_items'] ?? null;
        $options['add_button_text'] = $options['add_button_text'] ?? 'Add Item';
        $options['remove_button_text'] = $options['remove_button_text'] ?? 'Remove';
        
        // If the value is stored as a JSON string, decode it to an array
        if (isset($options['value']) && is_string($options['value'])) {
            $options['value'] = json_decode($options['value'], true) ?? [];
        }
        
        // Render the repeater field Blade view
        return view('cms::components.form_repeater', $options);
    }
}
