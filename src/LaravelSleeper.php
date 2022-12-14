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
}
