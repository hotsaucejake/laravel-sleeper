<?php

namespace HOTSAUCEJAKE\LaravelSleeper;

use HOTSAUCEJAKE\LaravelSleeper\Traits\MakesHttpRequests;

class LaravelSleeper
{
    use MakesHttpRequests;

    protected string $baseUri;

    public function __construct(string $baseUri = 'https://api.sleeper.app/')
    {
        $this->baseUri = $baseUri;
    }

    /**
     * ====================================
     * User
     * ====================================
     */
    public function getUserByName(string $name)
    {
        return $this->makeRequest('GET', "v1/user/{$name}");
    }

    public function getUserById(string $id)
    {
        return $this->makeRequest('GET', "v1/user/{$id}");
    }

    /**
     * ====================================
     * Avatars
     * ====================================
     */
    public function showAvatar(string $avatar_id)
    {
        return "https://sleepercdn.com/avatars/{$avatar_id}";
    }

    public function showAvatarThumbnail(string $avatar_id)
    {
        return "https://sleepercdn.com/avatars/thumbs/{$avatar_id}";
    }

    /**
     * ====================================
     * Leagues
     * ====================================
     */
    public function getAllLeaguesForUser(string $user_id, int $season, string $sport = 'nfl')
    {
        return $this->makeRequest('GET', "v1/user/{$user_id}/leagues/{$sport}/{$season}");
    }

    public function getLeague(string $league_id)
    {
        return $this->makeRequest('GET', "v1/league/{$league_id}");
    }

    public function getLeagueRosters(string $league_id)
    {
        return $this->makeRequest('GET', "v1/league/{$league_id}/rosters");
    }

    public function getLeagueUsers(string $league_id)
    {
        return $this->makeRequest('GET', "v1/league/{$league_id}/users");
    }

    public function getLeagueMatchups(string $league_id, int $week)
    {
        return $this->makeRequest('GET', "v1/league/{$league_id}/matchups/{$week}");
    }

    public function getLeaguePlayoffWinnersBracket(string $league_id)
    {
        return $this->makeRequest('GET', "v1/league/{$league_id}/winners_bracket");
    }

    public function getLeaguePlayoffLosersBracket(string $league_id)
    {
        return $this->makeRequest('GET', "v1/league/{$league_id}/losers_bracket");
    }

    public function getLeagueTransactions(string $league_id, int $round)
    {
        return $this->makeRequest('GET', "v1/league/{$league_id}/transactions/{$round}");
    }

    public function getLeagueTradedPicks(string $league_id)
    {
        return $this->makeRequest('GET', "v1/league/{$league_id}/traded_picks");
    }

    public function getSportState(string $sport = 'nfl')
    {
        return $this->makeRequest('GET', "v1/state/{$sport}");
    }

    /**
     * ====================================
     * Drafts
     * ====================================
     */
    public function getDraftsForUser(string $user_id, int $season, string $sport = 'nfl')
    {
        return $this->makeRequest('GET', "v1/user/{$user_id}/drafts/{$sport}/{$season}");
    }

    public function getLeagueDrafts(string $league_id)
    {
        return $this->makeRequest('GET', "v1/league/{$league_id}/drafts");
    }

    public function getSpecificDraft(string $draft_id)
    {
        return $this->makeRequest('GET', "v1/draft/{$draft_id}");
    }

    public function getDraftPicks(string $draft_id)
    {
        return $this->makeRequest('GET', "v1/draft/{$draft_id}/picks");
    }

    public function getDraftTradedPicks(string $draft_id)
    {
        return $this->makeRequest('GET', "v1/draft/{$draft_id}/traded_picks");
    }

    /**
     * ====================================
     * Players
     * ====================================
     */
    public function getAllPlayers(string $sport = 'nfl')
    {
        return $this->makeRequest('GET', "v1/players/{$sport}");
    }

    public function getTrendingPlayers(string $type = 'add', string $sport = 'nfl', int $lookback_hours = 24, int $limit = 25)
    {
        return $this->makeRequest('GET', "v1/players/{$sport}/trending/{$type}?lookback_hours={$lookback_hours}&limit={$limit}");
    }
}
