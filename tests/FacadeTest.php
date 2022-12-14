<?php

use HOTSAUCEJAKE\LaravelSleeper\Facades\LaravelSleeper as FacadesLaravelSleeper;
use HOTSAUCEJAKE\LaravelSleeper\LaravelSleeper;

it('can be instantiated via facade', function () {
    expect(FacadesLaravelSleeper::getFacadeRoot())->toBeInstanceOf(LaravelSleeper::class);
});

it('can be instantiated via the container', function () {
    expect(app('laravel-sleeper'))->toBeInstanceOf(LaravelSleeper::class);
});
