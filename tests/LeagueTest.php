<?php

use HOTSAUCEJAKE\LaravelSleeper\Facades\LaravelSleeper;

use function PHPUnit\Framework\assertTrue;

it('can get all leagues for for user', function () {
    $response = LaravelSleeper::getAllLeaguesForUser(env('SLEEPER_USER_ID'), 2022);
    assertTrue(!!$response);
});

it('can get a specific league', function () {
    $response = LaravelSleeper::getLeague(env('SLEEPER_LEAGUE'));
    assertTrue(!!$response);
});

it('can get rosters in a league', function () {
    $response = LaravelSleeper::getLeagueRosters(env('SLEEPER_LEAGUE'));
    assertTrue(!!$response);
});

it('can get users in a league', function () {
    $response = LaravelSleeper::getLeagueUsers(env('SLEEPER_LEAGUE'));
    assertTrue(!!$response);
});

it('can get matchups in a league', function () {
    $response = LaravelSleeper::getLeagueMatchups(env('SLEEPER_LEAGUE'), 1);
    assertTrue(!!$response);
});

it('can get winners bracket in playoffs', function () {
    $response = LaravelSleeper::getLeaguePlayoffWinnersBracket(env('SLEEPER_LEAGUE'));
    assertTrue(!!$response);
});

it('can get losers bracket in playoffs', function () {
    $response = LaravelSleeper::getLeaguePlayoffLosersBracket(env('SLEEPER_LEAGUE'));
    assertTrue(!!$response);
});

it('can get transactins for a round', function () {
    $response = LaravelSleeper::getLeagueTransactions(env('SLEEPER_LEAGUE'), 1);
    assertTrue(!!$response);
});

it('can get traded picks', function () {
    $response = LaravelSleeper::getLeagueTradedPicks(env('SLEEPER_LEAGUE'));
    assertTrue(!!$response);
});

it('can get sport state', function () {
    $response = LaravelSleeper::getSportState();
    assertTrue(!!$response);
});
