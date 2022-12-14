<?php

use HOTSAUCEJAKE\LaravelSleeper\Facades\LaravelSleeper;
use function PHPUnit\Framework\assertNotNull;

it('can get user by username', function () {
    $response = LaravelSleeper::getUserByName(env('SLEEPER_USERNAME'));
    assertNotNull($response->user_id);
});

it('can get user by user_id', function () {
    $response = LaravelSleeper::getUserById(env('SLEEPER_USER_ID'));
    assertNotNull($response->user_id);
});
