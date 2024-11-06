<?php

namespace Mojar\Backend\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Mojar\Backend\Models\Taxonomy;
use Mojar\CMS\Repositories\BaseRepository;
use Mojar\CMS\Repositories\Exceptions\RepositoryException;

interface TaxonomyRepository extends BaseRepository
{
    public function findBySlug(string $slug): null|Taxonomy;

    /**
     * @param  int  $limit
     * @return LengthAwarePaginator
     * @throws RepositoryException
     */
    public function frontendListPaginate(int $limit): LengthAwarePaginator;

    public function frontendDetail(string $slug): ?Taxonomy;
}
