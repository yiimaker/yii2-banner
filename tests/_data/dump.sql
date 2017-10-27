PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: banner
DROP TABLE IF EXISTS banner;

CREATE TABLE banner(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  slug STRING NOT NULL UNIQUE
--   published BOOLEAN NOT NULL DEFAULT VALUE true,
--   views_count INTEGER NOT NULL DEFAULT VALUE 0
);

-- Table: banner_translation
DROP TABLE IF EXISTS banner_translation;

CREATE TABLE banner_translation(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  banner_id INTEGER NOT NULL,
  language STRING NOT NULL
);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;