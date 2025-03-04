<?php

namespace Mojahid\ContactForm\Repositories;

use Juzaweb\CMS\Repositories\Criterias\SortCriteria;
use Juzaweb\CMS\Repositories\Interfaces\SortableInterface;
use Juzaweb\CMS\Traits\Criterias\UseSortableCriteria;
use Mojahid\ContactForm\Models\Contact;
use Juzaweb\CMS\Repositories\BaseRepositoryEloquent;

class ContactRepositoryEloquent extends BaseRepositoryEloquent implements ContactRepository, SortableInterface
{
    use UseSortableCriteria;

    protected array $sortableDefaults = [
        'created_at' => 'desc',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Contact::class;
    }

    public function boot(): void
    {
        $this->pushCriteria(SortCriteria::class);
    }
}
