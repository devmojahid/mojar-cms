<?php

namespace Mojar\Backend\Repositories;

use Mojar\Backend\Models\MediaFile;
use Mojar\CMS\Repositories\BaseRepositoryEloquent;
use Mojar\CMS\Traits\Criterias\UseFilterCriteria;
use Mojar\CMS\Traits\Criterias\UseSearchCriteria;
use Mojar\CMS\Traits\Criterias\UseSortableCriteria;

/**
 * Class MediaFileRepositoryEloquent.
 *
 * @package namespace Mojar\Backend\Repositories;
 */
class MediaFileRepositoryEloquent extends BaseRepositoryEloquent implements MediaFileRepository
{
    use UseSortableCriteria, UseFilterCriteria, UseSearchCriteria;

    protected array $searchableFields = ['name'];
    protected array $filterableFields = ['folder_id', 'type'];
    protected array $sortableFields = ['id', 'size'];
    protected array $sortableDefaults = ['id' => 'DESC'];

    public function model(): string
    {
        return MediaFile::class;
    }
}
