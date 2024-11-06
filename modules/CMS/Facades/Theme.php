<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Mojar\CMS\Facades;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade as FacadeAlias;
use Mojar\CMS\Support\LocalThemeRepository;
use Mojar\CMS\Support\Theme as ThemeSupport;

/**
 * @method static ThemeSupport|null find(string $name)
 * @method static ThemeSupport currentTheme()
 * @method static void activate(string $name)
 * @method static void delete(string $name)
 * @method static Factory|View|string render(string $view, array $params = [], ?string $theme = null)
 * @method static array|Collection all(bool $collection = false)
 * @method static mixed parseParam(mixed $param)
 *
 * @see LocalThemeRepository
 */
class Theme extends FacadeAlias
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'themes';
    }
}
