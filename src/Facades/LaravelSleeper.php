<?php

namespace HOTSAUCEJAKE\LaravelSleeper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HOTSAUCEJAKE\LaravelSleeper\LaravelSleeper
 */
class LaravelSleeper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HOTSAUCEJAKE\LaravelSleeper\LaravelSleeper::class;
    }
}
