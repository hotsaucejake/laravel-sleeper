<?php

use HOTSAUCEJAKE\LaravelSleeper\Facades\LaravelSleeper;

use function PHPUnit\Framework\assertTrue;

it('can get all drafts for user', function () {
    $response = LaravelSleeper::getDraftsForUser(env('SLEEPER_USER_ID'), 2022);
    assertTrue((bool) $response);
});

it('can get all drafts for a league', function (){
    $response = LaravelSleeper::getLeagueDrafts(env('SLEEPER_LEAGUE'));
    assertTrue((bool) $response);
});

it('can get a specific draft', function () {
    $response = LaravelSleeper::getSpecificDraft(env('SLEEPER_DRAFT'));
    assertTrue((bool) $response);
});

it('can get all picks in a draft', function () {
    $response = LaravelSleeper::getDraftPicks(env('SLEEPER_DRAFT'));
    assertTrue((bool) $response);
});

it('can get traded picks in a draft', function () {
    $response = LaravelSleeper::getDraftTradedPicks(env('SLEEPER_DRAFT'));
    assertTrue((bool) $response);
});
