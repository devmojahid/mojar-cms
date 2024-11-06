<?php

namespace Mojar\CMS\Traits\Criterias;

use Mojar\CMS\Repositories\Criterias\SearchCriteria;

/**
 * @property array $searchableFields
 */
trait UseSearchCriteria
{
    public function withSearchs(?string $keyword): static
    {
        $this->pushCriteria(new SearchCriteria(['keyword' => $keyword]));

        return $this;
    }

    public function getFieldSearchable(): array
    {
        return $this->searchableFields;
    }
}
