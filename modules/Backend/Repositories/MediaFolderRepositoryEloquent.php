<?php

namespace Mojar\Backend\Repositories;

use Mojar\Backend\Models\MediaFolder;
use Mojar\CMS\Repositories\BaseRepositoryEloquent;
use Mojar\CMS\Traits\Criterias\UseFilterCriteria;
use Mojar\CMS\Traits\Criterias\UseSearchCriteria;
use Mojar\CMS\Traits\Criterias\UseSortableCriteria;

/**
 * Class MediaFolderRepositoryEloquent.
 *
 * @property MediaFolder $model
 */
class MediaFolderRepositoryEloquent extends BaseRepositoryEloquent implements MediaFolderRepository
{
    use UseSortableCriteria, UseFilterCriteria, UseSearchCriteria;

    protected array $searchableFields = ['name'];
    protected array $filterableFields = ['folder_id', 'type'];
    protected array $sortableFields = ['id'];
    protected array $sortableDefaults = ['id' => 'DESC'];

    public function model(): string
    {
        return MediaFolder::class;
    }
}
