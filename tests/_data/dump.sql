PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: banner
DROP TABLE IF EXISTS banner;

CREATE TABLE banner(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  slug STRING NOT NULL UNIQUE,
  published INTEGER NOT NULL DEFAULT 1,
  views_count INTEGER UNSIGNED NOT NULL DEFAULT 0,
  created_at INTEGER UNSIGNED,
  updated_at INTEGER UNSIGNED
);

-- Table: banner_translation
DROP TABLE IF EXISTS banner_translation;

CREATE TABLE banner_translation(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  banner_id INTEGER NOT NULL,
  language STRING NOT NULL,
  content TEXT NULL,
  hint STRING NULL,
  file_name STRING NOT NULL,
  alt STRING NULL,
  link STRING NOT NULL DEFAULT '#'
);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;