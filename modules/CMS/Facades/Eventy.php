<?php

namespace Mojar\CMS\Facades;

use Illuminate\Support\Facades\Facade;
use Mojar\CMS\Contracts\EventyContract;

class Eventy extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return EventyContract::class;
    }
}
