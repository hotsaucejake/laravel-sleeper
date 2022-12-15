# An API wrapper for the fantasy Sleeper app

https://sleeper.com

https://docs.sleeper.com/

## Installation

You can install the package via composer:

```bash
composer require hotsaucejake/laravel-sleeper
```

## Usage

```php
use HOTSAUCEJAKE\LaravelSleeper\Facades\LaravelSleeper;

/**
 * ====================================
 * User
 * ====================================
 */
LaravelSleeper::getUserByName('SLEEPER_USERNAME');
LaravelSleeper::getUserById('SLEEPER_USER_ID');

/**
 * ====================================
 * Avatars
 * ====================================
 */
LaravelSleeper::showAvatar('SLEEPER_AVATAR_ID');
LaravelSleeper::showAvatarThumbnail('SLEEPER_AVATAR_ID');

/**
 * ====================================
 * Leagues
 * ====================================
 */
LaravelSleeper::getAllLeaguesForUser('SLEEPER_USER_ID', 2022);
LaravelSleeper::getLeague('SLEEPER_LEAGUE_ID');
LaravelSleeper::getLeagueRosters('SLEEPER_LEAGUE_ID');
LaravelSleeper::getLeagueUsers('SLEEPER_LEAGUE_ID');
LaravelSleeper::getLeagueMatchups('SLEEPER_LEAGUE_ID', 1);
LaravelSleeper::getLeaguePlayoffWinnersBracket('SLEEPER_LEAGUE_ID');
LaravelSleeper::getLeaguePlayoffLosersBracket('SLEEPER_LEAGUE_ID');
LaravelSleeper::getLeagueTransactions('SLEEPER_LEAGUE_ID', 1);
LaravelSleeper::getLeagueTradedPicks('SLEEPER_LEAGUE_ID');
LaravelSleeper::getSportState();

/**
 * ====================================
 * Drafts
 * ====================================
 */
LaravelSleeper::getDraftsForUser('SLEEPER_USER_ID', 2022);
LaravelSleeper::getLeagueDrafts('SLEEPER_LEAGUE_ID');
LaravelSleeper::getSpecificDraft('SLEEPER_DRAFT_ID');
LaravelSleeper::getDraftPicks('SLEEPER_DRAFT_ID');
LaravelSleeper::getDraftTradedPicks('SLEEPER_DRAFT_ID');

/**
 * ====================================
 * Players
 * ====================================
 */
LaravelSleeper::getAllPlayers();
LaravelSleeper::getTrendingPlayers('add');
LaravelSleeper::getTrendingPlayers('drop');

```

## Testing
In order to run the package tests you must create an `.env` file from the `.env.example` file.  Tests will use the live endpoints.  Since it's under the API rate limit, it's ok for now.  I don't think this package will get any bigger than it already is so no need for mocks, etc...

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [hotsaucejake](https://github.com/hotsaucejake)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
