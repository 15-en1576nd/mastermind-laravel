# Mastermind-laravel

![test](https://github.com/15-en1576nd/mastermind-laravel/actions/workflows/tests.yaml/badge.svg)
![build](https://github.com/15-en1576nd/mastermind-laravel/actions/workflows/docker-publish.yaml/badge.svg)

## Architecture

When a user starts the game, the user gets redirected to /game/<game id>
Everyone has read access to this page. But only the game creator can write to it.

All games are stored in a database. The games table looks like this:

<!-- Bash has closest syntax highlighting -->
```bash
game
---
id INDEX int
code_length int
score NULL int
# Static virtual field in the model definition
emoji_map VIRTUAL
# Stored in session, but added to model
selected_emoji VIRTUAL

row
---
id INDEX AUTOINCREMENT int
# A game has many rows
game_id INDEX int FK >- game.id

slot
---
id INDEX AUTOINCREMENT int
# A row has many slots
row_id INDEX int FK >- row.id
# Value of 0-8 which can be looked up in
# the game->emoji_map
value int
# A hint is either 0, 1 or 2. Where 0 is no
# hint, 1 is exact and 2 is partial
hint int
```

Table for users:

```sql
CREATE TABLE users (
  id number PRIMARY KEY,
  name TEXT,
  email TEXT,
  password TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
);
