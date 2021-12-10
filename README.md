# Mastermind-laravel

![test](https://github.com/15-en1576nd/mastermind-laravel/actions/workflows/tests.yaml/badge.svg)
![build](https://github.com/15-en1576nd/mastermind-laravel/actions/workflows/docker-publish.yaml/badge.svg)

## Architecture

When a user starts the game, the user gets redirected to /game/<game id>
Everyone has read access to this page. But only the game creator can write to it.

All games are stored in a database. The games table looks like this:

```sql
CREATE TABLE games (
  id TEXT PRIMARY KEY,
  code TEXT,
  board TEXT, -- JSON object with the board. The board is an array of arrays. Each array is a row. Each row is an array of Emojis(in integer form).
  hints TEXT, -- JSON object with the hints. The hints are an array of arrays. Each array is a row. Each row is an array of integers ranging from 0 to 2. With 0 being no hint, 1 being an exact match and 2 being a partial match.
  lost INTEGER, -- 0 or 1
  won INTEGER, -- 0 or 1
  turn INTEGER, -- should be pretty obvious what this is... Right?
  owner_id number, -- Add later on when we do user authentication
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
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
