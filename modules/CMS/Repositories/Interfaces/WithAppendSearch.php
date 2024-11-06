<?php

namespace Mojar\CMS\Repositories\Interfaces;

interface WithAppendSearch
{
    public function appendCustomSearch($builder, $keyword, $input);
}
