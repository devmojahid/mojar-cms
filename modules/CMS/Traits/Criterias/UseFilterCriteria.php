<?php

namespace Mojar\CMS\Traits\Criterias;

use Mojar\CMS\Repositories\Criterias\FilterCriteria;

/**
 * @property array $filterableFields
 */
trait UseFilterCriteria
{
    public function withFilters(array $filters): static
    {
        $this->pushCriteria(new FilterCriteria($filters));

        return $this;
    }

    public function getFieldFilterable(): array
    {
        return $this->filterableFields ?? [];
    }
}
