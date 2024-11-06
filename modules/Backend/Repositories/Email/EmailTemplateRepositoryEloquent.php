<?php

namespace Mojar\Backend\Repositories\Email;

use Mojar\Backend\Models\EmailTemplate;
use Mojar\CMS\Repositories\BaseRepositoryEloquent;
use Mojar\CMS\Traits\Criterias\UseFilterCriteria;
use Mojar\CMS\Traits\Criterias\UseSearchCriteria;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace Mojar\Backend\Repositories;
 */
class EmailTemplateRepositoryEloquent extends BaseRepositoryEloquent implements EmailTemplateRepository
{
    use UseSearchCriteria, UseFilterCriteria;

    protected array $searchableFields = ['code', 'subject'];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return EmailTemplate::class;
    }
}
