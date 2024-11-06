<?php

namespace Mojar\Backend\Repositories;

use Mojar\Backend\Models\Resource;
use Mojar\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace Mojar\Backend\Repositories;
 */
class ResourceRepositoryEloquent extends BaseRepositoryEloquent implements ResourceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Resource::class;
    }
}
