<?php

namespace Mojar\Backend\Repositories;

use Mojar\Backend\Models\Menu;
use Mojar\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace Mojar\Backend\Repositories;
 */
class MenuRepositoryEloquent extends BaseRepositoryEloquent implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Menu::class;
    }

    public function getFrontendDetail(int $menu): Menu
    {
        $result = $this->model->newQuery()
            ->cacheFor(config('mojar.performance.query_cache.lifetime'))
            ->where(['id' => $menu])
            ->firstOrFail();

        return $this->parserResult($result);
    }

    public function getFrontendDetailByLocation(string $location): ?Menu
    {
        $menu = get_menu_by_theme_location($location);
        if (empty($menu)) {
            return null;
        }

        $result = $this->model->newQuery()
            ->cacheFor(config('mojar.performance.query_cache.lifetime'))
            ->where(['id' => $menu])
            ->first();

        return $this->parserResult($result);
    }
}
