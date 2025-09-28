# Sleeper API Documentation

## Introduction

The Sleeper API is a read-only HTTP API that is free to use and allows access to a user's leagues, drafts, and rosters.

- **No API Token required** - API is read-only and cannot modify contents
- **Base URL**: `https://api.sleeper.app/`
- **Rate Limit**: Stay under 1000 API calls per minute to avoid IP blocking
- **Sports Supported**: Currently only NFL

## User Endpoints

### Get User by Username or ID
- **URL**: `GET /v1/user/<username>` or `GET /v1/user/<user_id>`
- **Description**: Fetch a user object by username or user ID
- **Response Example**:
```json
{
  "username": "sleeperuser",
  "user_id": "12345678",
  "display_name": "SleeperUser",
  "avatar": "cc12ec49965eb7856f84d71cf85306af"
}
```
- **Note**: Username can change over time, store user_id for permanent reference

## Avatars

Avatar images are available in two sizes:
- **Full size**: `https://sleepercdn.com/avatars/<avatar_id>`
- **Thumbnail**: `https://sleepercdn.com/avatars/thumbs/<avatar_id>`

## League Endpoints

### Get All Leagues for User
- **URL**: `GET /v1/user/<user_id>/leagues/<sport>/<season>`
- **Parameters**:
  - `user_id`: Numerical ID of the user
  - `sport`: Currently only "nfl"
  - `season`: Year (e.g., 2018, 2019, etc.)
- **Response**: Array of league objects with status, settings, scoring, roster positions, etc.

### Get Specific League
- **URL**: `GET /v1/league/<league_id>`
- **Parameters**:
  - `league_id`: ID of the league to retrieve
- **Response**: Single league object

### Get League Rosters
- **URL**: `GET /v1/league/<league_id>/rosters`
- **Response**: Array of roster objects containing:
  - `starters`: Array of player IDs in starting lineup
  - `players`: Array of all player IDs on roster
  - `reserve`: Array of reserve players
  - `settings`: Win/loss record, points, waiver info
  - `roster_id`: Unique roster identifier
  - `owner_id`: User ID of roster owner

### Get League Users
- **URL**: `GET /v1/league/<league_id>/users`
- **Response**: Array of user objects with:
  - `user_id`, `username`, `display_name`, `avatar`
  - `metadata`: May include team_name
  - `is_owner`: Boolean indicating commissioner status

### Get League Matchups
- **URL**: `GET /v1/league/<league_id>/matchups/<week>`
- **Parameters**:
  - `week`: Week number for matchups
- **Response**: Array of matchup objects
- **Key Fields**:
  - `starters`: Ordered list of starting player IDs
  - `players`: All player IDs for the team
  - `matchup_id`: Teams with same ID play each other
  - `points`: Total points scored
  - `custom_points`: Commissioner override points

### Get Playoff Bracket
- **URLs**:
  - `GET /v1/league/<league_id>/winners_bracket`
  - `GET /v1/league/<league_id>/losers_bracket`
- **Response**: Array of bracket matchups with:
  - `r`: Round number
  - `m`: Match ID (unique within bracket)
  - `t1`, `t2`: Team roster IDs or references to other matches
  - `w`, `l`: Winner/loser roster IDs (if completed)
  - `t1_from`, `t2_from`: Source of teams (winner/loser of previous match)

### Get Transactions
- **URL**: `GET /v1/league/<league_id>/transactions/<round>`
- **Parameters**:
  - `round`: Week number
- **Response**: Array of transaction objects including:
  - **Trade transactions**:
    - `type`: "trade"
    - `roster_ids`: Involved rosters
    - `adds`, `drops`: Player movements
    - `draft_picks`: Traded picks with season, round, ownership
    - `waiver_budget`: FAAB transfers
  - **Free agent/waiver transactions**:
    - `type`: "free_agent" or "waiver"
    - `settings`: May include waiver_bid for FAAB
    - `metadata`: Notes about transaction

### Get Traded Picks
- **URL**: `GET /v1/league/<league_id>/traded_picks`
- **Response**: Array of traded pick objects:
  - `season`: Which season the pick is for
  - `round`: Which round
  - `roster_id`: Original owner
  - `previous_owner_id`: Previous owner
  - `owner_id`: Current owner

### Get Sport State
- **URL**: `GET /v1/state/<sport>`
- **Parameters**:
  - `sport`: "nfl", "nba", "lcs", etc.
- **Response**: Current state information:
  - `week`: Current week
  - `season_type`: "pre", "regular", "post"
  - `season`: Current season year
  - `previous_season`: Previous season year
  - `league_season`: Active season for leagues
  - `display_week`: Week to show in UI

## Draft Endpoints

### Get All Drafts for User
- **URL**: `GET /v1/user/<user_id>/drafts/<sport>/<season>`
- **Parameters**: Same as league endpoint
- **Response**: Array of draft objects

### Get All Drafts for League
- **URL**: `GET /v1/league/<league_id>/drafts`
- **Response**: Array of draft objects (sorted newest to oldest)

### Get Specific Draft
- **URL**: `GET /v1/draft/<draft_id>`
- **Response**: Draft object including:
  - `draft_order`: user_id to draft slot mapping
  - `slot_to_roster_id`: draft slot to roster_id mapping
  - `settings`: Draft configuration (rounds, pick timer, slots)
  - `status`: "complete", "drafting", etc.

### Get Draft Picks
- **URL**: `GET /v1/draft/<draft_id>/picks`
- **Response**: Array of pick objects:
  - `player_id`: ID of drafted player
  - `picked_by`: User ID who made pick
  - `roster_id`: Roster receiving the pick
  - `round`, `draft_slot`, `pick_no`: Pick location info
  - `metadata`: Player information (name, team, position, etc.)
  - `is_keeper`: Keeper league indicator

### Get Traded Picks in Draft
- **URL**: `GET /v1/draft/<draft_id>/traded_picks`
- **Response**: Similar to league traded picks but specific to draft

## Player Endpoints

### Fetch All Players
- **URL**: `GET /v1/players/<sport>`
- **Response**: Object with player_id as keys, player objects as values
- **Player Object Fields**:
  - `player_id`: Unique identifier
  - `first_name`, `last_name`: Player name
  - `position`: Primary position
  - `fantasy_positions`: Array of fantasy eligible positions
  - `team`: Team abbreviation
  - `number`: Jersey number
  - `height`, `weight`, `age`: Physical stats
  - `college`, `years_exp`: Background info
  - `status`: "Active", "Injured Reserve", etc.
  - `injury_status`: Current injury status
  - `depth_chart_position`: Position on depth chart
- **Important**: Large response (~5MB), cache locally, call max once per day

### Get Trending Players
- **URL**: `GET /v1/players/<sport>/trending/<type>?lookback_hours=<hours>&limit=<int>`
- **Parameters**:
  - `sport`: "nfl", etc.
  - `type`: "add" or "drop"
  - `lookback_hours`: Hours to look back (default: 24)
  - `limit`: Number of results (default: 25)
- **Response**: Array of objects with `player_id` and `count`

## Error Codes

| Code | Meaning |
|------|---------|
| 400 | Bad Request - Invalid request |
| 404 | Not Found - Resource not found |
| 429 | Too Many Requests - Rate limit exceeded |
| 500 | Internal Server Error - Server problem |
| 503 | Service Unavailable - Maintenance mode |

## Important Notes

1. **Player IDs**: Can be numeric ("1042") or team abbreviations ("CAR") for defenses
2. **Caching**: Cache player data locally - don't call players endpoint frequently
3. **Rate Limiting**: Stay under 1000 calls per minute
4. **Dynasty Leagues**: Can have multiple drafts
5. **Roster vs User**: Rosters have `roster_id`, users have `user_id` - they're linked through leagues
6. **Matchup Logic**: Teams with same `matchup_id` play each other
7. **Bench Players**: Calculate by removing `starters` from `players` array

## Data Relationships

```
User -> Leagues -> Rosters -> Players
User -> Drafts -> Picks -> Players
League -> Matchups -> Teams (Rosters)
League -> Transactions -> Player Movements
```