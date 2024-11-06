<?php

namespace Mojar\CMS\Repositories\Interfaces;

interface WithAppendFilter
{
    public function appendCustomFilter($builder, $input);
}
