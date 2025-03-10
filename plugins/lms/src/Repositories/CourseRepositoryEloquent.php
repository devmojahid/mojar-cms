<?php

namespace Mojahid\Lms\Repositories;

use Juzaweb\Backend\Repositories\PostRepositoryEloquent;
use Mojahid\Lms\Models\Course;

/**
 * Class TaxonomyRepositoryEloquentEloquent.
 *
 * @package namespace Mojahid\Lms\Repositories;
 */
class CourseRepositoryEloquent extends PostRepositoryEloquent implements CourseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Course::class;
    }
}
