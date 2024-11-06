<?php

/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    mojar/cms
 * @author     Mojar Team <admin@mojar.com>
 * @link       https://mojar.com
 * @license    MIT
 */

namespace Mojar\CMS\Support\Manager;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Mojar\CMS\Contracts\GoogleTranslate;
use Mojar\CMS\Contracts\LocalPluginRepositoryContract;
use Mojar\CMS\Contracts\LocalThemeRepositoryContract;
use Mojar\CMS\Contracts\TranslationFinder;
use Mojar\CMS\Contracts\TranslationManager as TranslationManagerContract;
use Mojar\CMS\Facades\Plugin;
use Mojar\CMS\Facades\ThemeLoader;
use Mojar\CMS\Models\Translation;
use Mojar\CMS\Support\Translations\TranslationExporter;
use Mojar\CMS\Support\Translations\TranslationImporter;
use Mojar\CMS\Support\Translations\TranslationLocale;
use Mojar\CMS\Support\Translations\TranslationTranslate;

class TranslationManager implements TranslationManagerContract
{
    public function __construct(
        protected LocalPluginRepositoryContract $pluginRepository,
        protected LocalThemeRepositoryContract $themeRepository,
        protected TranslationFinder $translationFinder,
        protected GoogleTranslate $googleTranslate
    ) {}

    public function export(string $module = 'cms', string $name = null): TranslationExporter
    {
        $module = $this->find($module, $name);

        return $this->createTranslationExporter($module);
    }

    public function import(string $module, string $name = null): TranslationImporter
    {
        $module = $this->find($module, $name);

        return $this->createTranslationImporter($module);
    }

    public function translate(
        string $source,
        string $target,
        string $module = 'cms',
        string $name = 'core'
    ): TranslationTranslate {
        $module = $this->find($module, $name);

        return $this->createTranslationTranslate($module)->setSource($source)->setTarget($target);
    }

    public function locale(string|Collection $module, string $name = null): TranslationLocale
    {
        $module = $this->find($module, $name);

        return $this->createTranslationLocale($module);
    }

    public function find(string|Collection $module, string $name = null): Collection
    {
        if ($module instanceof Collection) {
            return $module;
        }

        switch ($module) {
            case 'plugin':
                $plugin = $this->pluginRepository->find($name);
                if (empty($plugin)) {
                    throw new \Exception("Plugin {$name} not found");
                }

                return new Collection(
                    [
                        'key' => $plugin->getSnakeName(),
                        'title' => $plugin->getDisplayName(),
                        'name' => $plugin->get('name'),
                        'namespace' => $plugin->getDomainName(),
                        'type' => 'plugin',
                        'lang_path' => $plugin->getPath('src/resources/lang'),
                        'src_path' => $plugin->getPath('src'),
                        'publish_path' => resource_path("lang/plugins/{$name}"),
                    ]
                );
            case 'theme':
                $theme = $this->themeRepository->find($name);
                if (empty($theme)) {
                    throw new \Exception("Theme {$name} not found");
                }

                return new Collection(
                    [
                        'key' => 'theme_' . $theme->get('name'),
                        'title' => $theme->get('title'),
                        'name' => $theme->get('name'),
                        'namespace' => '*',
                        'type' => 'theme',
                        'lang_path' => $theme->getPath('lang'),
                        'src_path' => $theme->getPath('views'),
                        'publish_path' => resource_path("lang/themes/{$name}"),
                    ]
                );
            case 'cms':
                return new Collection(
                    [
                        'key' => 'core',
                        'title' => 'CMS',
                        'namespace' => 'cms',
                        'type' => 'cms',
                        'lang_path' => base_path('modules/Backend/resources/lang'),
                        'src_path' => base_path('modules'),
                        'publish_path' => resource_path('lang/vendor/cms'),
                    ]
                );
        }

        throw new \Exception('Module not found');
    }

    public function modules(): Collection
    {
        $result['core'] = $this->find('cms');
        $themes = ThemeLoader::all();
        foreach ($themes as $theme) {
            $info = $this->find('theme', $theme->get('name'));
            $result[$info->get('key')] = $info;
        }

        $plugins = Plugin::all();
        foreach ($plugins as $plugin) {
            $info = $this->find('plugin', $plugin->get('name'));
            $result[$info->get('key')] = $info;
        }

        return collect($result);
    }

    public function importTranslationLine(array $data, bool $force = false): Translation
    {
        if ($force) {
            return Translation::updateOrCreate(
                Arr::only($data, ['locale', 'group', 'namespace', 'key', 'object_type', 'object_key']),
                Arr::only($data, ['value'])
            );
        }

        return Translation::firstOrCreate(
            Arr::only($data, ['locale', 'group', 'namespace', 'key', 'object_type', 'object_key']),
            Arr::only($data, ['value'])
        );
    }

    protected function createTranslationLocale(Collection $module): TranslationLocale
    {
        return new TranslationLocale($module);
    }

    protected function createTranslationExporter(Collection $module): TranslationExporter
    {
        return new TranslationExporter($module);
    }

    protected function createTranslationTranslate(Collection $module): TranslationTranslate
    {
        return new TranslationTranslate(
            $module,
            $this->googleTranslate,
            $this
        );
    }

    protected function createTranslationImporter(Collection $module): TranslationImporter
    {
        return new TranslationImporter(
            $module,
            $this->translationFinder,
            $this
        );
    }
}
