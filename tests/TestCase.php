<?php

namespace HOTSAUCEJAKE\LaravelSleeper\Tests;

use Dotenv\Dotenv;
use HOTSAUCEJAKE\LaravelSleeper\LaravelSleeperServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelSleeperServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
