# Laravel Sleeper API Wrapper

A comprehensive Laravel package for interacting with the [Sleeper Fantasy Sports API](https://sleeper.com). This package provides easy access to all Sleeper API endpoints including users, leagues, drafts, players, and more.

**Official Sleeper Resources:**
- [Sleeper App](https://sleeper.com)
- [Sleeper API Documentation](https://docs.sleeper.com/)

## Installation

You can install the package via composer:

```bash
composer require hotsaucejake/laravel-sleeper
```

## API Overview

The Sleeper API is read-only and requires no authentication. All methods return JSON objects/arrays containing the requested data. Rate limit: stay under 1000 calls per minute.

## Complete Usage Guide

```php
use HOTSAUCEJAKE\LaravelSleeper\Facades\LaravelSleeper;
```

---

## 👤 User Endpoints

### `getUserByName(string $username)`
Retrieves user information by username.

```php
$user = LaravelSleeper::getUserByName('sleeperuser');
// Returns: { "username": "sleeperuser", "user_id": "12345678", "display_name": "SleeperUser", "avatar": "..." }
```

### `getUserById(string $user_id)`
Retrieves user information by user ID. Recommended over username since usernames can change.

```php
$user = LaravelSleeper::getUserById('12345678');
// Returns: Same format as getUserByName()
```

---

## 🖼️ Avatar Endpoints

### `showAvatar(string $avatar_id)`
Returns the full-size avatar URL for a given avatar ID.

```php
$avatarUrl = LaravelSleeper::showAvatar('cc12ec49965eb7856f84d71cf85306af');
// Returns: "https://sleepercdn.com/avatars/cc12ec49965eb7856f84d71cf85306af"
```

### `showAvatarThumbnail(string $avatar_id)`
Returns the thumbnail avatar URL for a given avatar ID.

```php
$thumbnailUrl = LaravelSleeper::showAvatarThumbnail('cc12ec49965eb7856f84d71cf85306af');
// Returns: "https://sleepercdn.com/avatars/thumbs/cc12ec49965eb7856f84d71cf85306af"
```

---

## 🏆 League Endpoints

### `getAllLeaguesForUser(string $user_id, int $season, string $sport = 'nfl')`
Retrieves all leagues for a specific user in a given season.

```php
$leagues = LaravelSleeper::getAllLeaguesForUser('12345678', 2024);
// Returns: Array of league objects with settings, roster info, scoring settings, etc.
```

### `getLeague(string $league_id)`
Retrieves detailed information about a specific league.

```php
$league = LaravelSleeper::getLeague('289646328504385536');
// Returns: Single league object with full configuration details
```

### `getLeagueRosters(string $league_id)`
Retrieves all rosters in a league with current players, starters, and team records.

```php
$rosters = LaravelSleeper::getLeagueRosters('289646328504385536');
// Returns: Array of roster objects with starters[], players[], settings{wins, losses, points}, etc.
```

### `getLeagueUsers(string $league_id)`
Retrieves all users/managers in a league with their team information.

```php
$users = LaravelSleeper::getLeagueUsers('289646328504385536');
// Returns: Array of user objects with metadata{team_name}, is_owner (commissioner status), etc.
```

### `getLeagueMatchups(string $league_id, int $week)`
Retrieves all matchups for a specific week. Teams with the same `matchup_id` play each other.

```php
$matchups = LaravelSleeper::getLeagueMatchups('289646328504385536', 1);
// Returns: Array with starters[], players[], matchup_id, points, custom_points
```

### `getLeaguePlayoffWinnersBracket(string $league_id)`
Retrieves the winners bracket for league playoffs.

```php
$bracket = LaravelSleeper::getLeaguePlayoffWinnersBracket('289646328504385536');
// Returns: Array of bracket rounds with team progressions and results
```

### `getLeaguePlayoffLosersBracket(string $league_id)`
Retrieves the losers bracket for league playoffs (consolation bracket).

```php
$bracket = LaravelSleeper::getLeaguePlayoffLosersBracket('289646328504385536');
// Returns: Array of bracket rounds for consolation games
```

### `getLeagueTransactions(string $league_id, int $round)`
Retrieves all transactions (trades, waivers, free agents) for a specific week/round.

```php
$transactions = LaravelSleeper::getLeagueTransactions('289646328504385536', 1);
// Returns: Array of transactions with type, adds{}, drops{}, draft_picks[], waiver_budget[]
```

### `getLeagueTradedPicks(string $league_id)`
Retrieves all traded draft picks in a league, including future picks.

```php
$tradedPicks = LaravelSleeper::getLeagueTradedPicks('289646328504385536');
// Returns: Array with season, round, roster_id (original), owner_id (current)
```

### `getSportState(string $sport = 'nfl')`
Retrieves current state information for the sport (current week, season, etc.).

```php
$state = LaravelSleeper::getSportState('nfl');
// Returns: { week, season_type, season, previous_season, league_season, display_week }
```

---

## 📋 Draft Endpoints

### `getDraftsForUser(string $user_id, int $season, string $sport = 'nfl')`
Retrieves all drafts for a specific user in a given season.

```php
$drafts = LaravelSleeper::getDraftsForUser('12345678', 2024);
// Returns: Array of draft objects with type, status, settings, metadata
```

### `getLeagueDrafts(string $league_id)`
Retrieves all drafts for a specific league (dynasty leagues may have multiple drafts).

```php
$drafts = LaravelSleeper::getLeagueDrafts('289646328504385536');
// Returns: Array of draft objects sorted by most recent
```

### `getSpecificDraft(string $draft_id)`
Retrieves detailed information about a specific draft.

```php
$draft = LaravelSleeper::getSpecificDraft('289646328508579840');
// Returns: Draft object with draft_order{}, slot_to_roster_id{}, settings{}
```

### `getDraftPicks(string $draft_id)`
Retrieves all picks made in a specific draft with player details.

```php
$picks = LaravelSleeper::getDraftPicks('289646328508579840');
// Returns: Array of picks with player_id, picked_by, roster_id, round, metadata{player info}
```

### `getDraftTradedPicks(string $draft_id)`
Retrieves all traded picks within a specific draft.

```php
$tradedPicks = LaravelSleeper::getDraftTradedPicks('289646328508579840');
// Returns: Array similar to league traded picks but specific to this draft
```

---

## 🏈 Player Endpoints

### `getAllPlayers(string $sport = 'nfl')`
Retrieves all players in the database. **Important:** This is a large response (~5MB) - cache locally and call max once per day.

```php
$players = LaravelSleeper::getAllPlayers('nfl');
// Returns: Object with player_id as keys, player objects with name, position, team, stats, etc.
```

### `getTrendingPlayers(string $type = 'add', string $sport = 'nfl', int $lookback_hours = 24, int $limit = 25)`
Retrieves trending players based on add/drop activity.

```php
// Most added players in last 24 hours
$trending = LaravelSleeper::getTrendingPlayers('add');

// Most dropped players in last 48 hours, limit 10
$dropped = LaravelSleeper::getTrendingPlayers('drop', 'nfl', 48, 10);

// Returns: Array of { player_id, count } objects
```

---

## 💡 Usage Tips

### Working with Player IDs
Player IDs can be numeric strings (`"1042"`) or team abbreviations (`"CAR"` for team defenses).

```php
// Get all players to create a lookup map
$players = LaravelSleeper::getAllPlayers();
$playerName = $players['1042']['first_name'] . ' ' . $players['1042']['last_name'];
$teamDefense = $players['CAR']['position']; // "DEF"
```

### Finding Matchup Results
Teams with the same `matchup_id` play against each other:

```php
$matchups = LaravelSleeper::getLeagueMatchups('league_id', 1);
foreach ($matchups as $team) {
    // Find opponent by matching matchup_id
    $opponent = collect($matchups)->where('matchup_id', $team['matchup_id'])
                                  ->where('roster_id', '!=', $team['roster_id'])
                                  ->first();
}
```

### Calculating Bench Players
Bench players = All players - Starting players:

```php
$roster = LaravelSleeper::getLeagueRosters('league_id')[0];
$bench = array_diff($roster['players'], $roster['starters']);
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
