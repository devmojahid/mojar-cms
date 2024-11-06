<?php

namespace Mojar\CMS\Repositories\Interfaces;

interface SearchableInterface
{
    public function withSearchs(string $keyword): static;

    public function getFieldSearchable();
}
