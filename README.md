# Mastermind-laravel

## Architecture

When a user starts the game, the user gets redirected to /game/<game id>
Everyone has read access to this page. But only the game creator can write to it.

All games are stored in a database. The games table looks like this:

```sql
CREATE TABLE games (
  id TEXT PRIMARY KEY,
  code TEXT,
  board TEXT, -- JSON object with the board. The board is an array of arrays. Each array is a row. Each row is an array of Emojis(in integer form).
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