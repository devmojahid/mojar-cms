<?php

namespace Mojar\Backend\Repositories;

use Mojar\Backend\Models\Menu;
use Mojar\CMS\Repositories\BaseRepository;

/**
 * Interface CommentRepository.
 *
 * @package namespace Mojar\Backend\Repositories;
 */
interface MenuRepository extends BaseRepository
{
    public function getFrontendDetail(int $menu): Menu;

    public function getFrontendDetailByLocation(string $location): ?Menu;
}
