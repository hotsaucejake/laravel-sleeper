<?php

use HOTSAUCEJAKE\LaravelSleeper\Facades\LaravelSleeper;
use function PHPUnit\Framework\assertTrue;

it('can fetch all players', function () {
    $response = LaravelSleeper::getAllPlayers();
    assertTrue((bool) $response);
});

it('can get trending players add', function () {
    $response = LaravelSleeper::getTrendingPlayers();
    assertTrue((bool) $response);
});

it('can get trending players drop', function () {
    $response = LaravelSleeper::getTrendingPlayers('drop');
    assertTrue((bool) $response);
});
