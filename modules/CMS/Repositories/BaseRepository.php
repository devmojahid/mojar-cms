<?php

namespace Mojar\CMS\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Mojar\CMS\Repositories\Contracts\RepositoryCriteriaInterface;
use Mojar\CMS\Repositories\Contracts\RepositoryInterface;

/**
 * Interface BaseRepository.
 *
 * @method Builder query()
 * @package namespace Mojar\Backend\Repositories;
 */
interface BaseRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    /**
     * @return Builder
     */
    public function getQuery(): Builder;

    public function resetModel();
}
