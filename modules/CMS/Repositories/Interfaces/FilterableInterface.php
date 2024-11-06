<?php

namespace Mojar\CMS\Repositories\Interfaces;

interface FilterableInterface
{
    public function withFilters(array $filters): static;

    public function getFieldFilterable(): array;
}
