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
}
