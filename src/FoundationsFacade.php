<?php

namespace NorthernEstateAgencies\ReapitFoundations;

use Illuminate\Support\Facades\Facade;

class FoundationsFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Foundations::class;
    }
}
