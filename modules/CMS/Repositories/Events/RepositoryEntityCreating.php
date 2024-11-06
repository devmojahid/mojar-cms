<?php

namespace Mojar\CMS\Repositories\Events;

use Mojar\CMS\Repositories\Contracts\RepositoryInterface;

/**
 * Class RepositoryEntityCreated
 *
 * @package Prettus\Repository\Events
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class RepositoryEntityCreating extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "creating";

    public function __construct(RepositoryInterface $repository, array $model)
    {
        parent::__construct($repository);
        $this->model = $model;
    }
}
