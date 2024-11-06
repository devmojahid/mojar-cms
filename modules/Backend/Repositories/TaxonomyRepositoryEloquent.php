<?php

namespace Mojar\Backend\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Mojar\Backend\Models\Taxonomy;
use Mojar\CMS\Repositories\BaseRepositoryEloquent;
use Mojar\CMS\Traits\Criterias\UseFilterCriteria;
use Mojar\CMS\Traits\Criterias\UseSearchCriteria;
use Mojar\CMS\Traits\Criterias\UseSortableCriteria;

/**
 * @property Taxonomy $model
 */
class TaxonomyRepositoryEloquent extends BaseRepositoryEloquent implements TaxonomyRepository
{
    use UseSortableCriteria, UseSearchCriteria, UseFilterCriteria;

    protected array $searchableFields = [
        'name',
        'description',
    ];

    protected array $filterableFields = [
        'name',
        'total_post',
        'post_type',
        'taxonomy',
    ];

    public function findBySlug(string $slug): null|Taxonomy
    {
        return $this->model->newQuery()->where('slug', $slug)->firstOrFail();
    }

    public function frontendDetail(string $slug): ?Taxonomy
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->createFrontendBuilder()->where(['slug' => $slug])->firstOrFail();

        $this->resetModel();
        $this->resetScope();

        return $this->parserResult($result);
    }

    public function frontendListPaginate(int $limit): LengthAwarePaginator
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->createFrontendBuilder()->paginate($limit);

        $this->resetModel();
        $this->resetScope();

        return $this->parserResult($result);
    }

    public function createFrontendBuilder(): Builder
    {
        return $this->model->newQuery();
    }

    public function model(): string
    {
        return Taxonomy::class;
    }
}
