# DMI-TCAT in Docker

This repository is a hackish attempt at containing [dmi-tcat](https://github.com/digitalmethodsinitiative/dmi-tcat) with Docker.

## Features

- Track
- Upcoming features
  - `follow` and `onepercent` roles are coming.

## Required environment variables

- __tcat_base_url__: The base URL for the application __with trailing slash__ (e.g., http://example.com/, http://tcat.example.com//).
- For `track` role:
    - __twitter_track_consumer_key__: Your [Twitter app's](https://apps.twitter.com) "Consumer Key (API Key)".
    - __twitter_track_consumer_secret__: Your Twitter app's "Consumer Secret (API Secret)".
    - __twitter_track_user_token__: Your Twitter app's "Access Token".
    - __twitter_track_user_secret__: Your Twitter app's "Access Token Secret".

## Files

This repository includes a few custom files.

### Things to run

- `build.sh` builds the image.
- Consider writing a wrapper (e.g.  `run-container.sh`) that sets the required environment variables.

### Things to edit?

- `config.php`: the main configuration file for DMI-TCAT; gets its values from the environment at runtime.
- `index.html`: The file to be served on URL `/`.

### Other things

- `apache-passwords`: .htpasswd format file, used to authenticate with HTTP Basic. Default users are:
  - `admin` with password `securitywoo` (can edit query bins at `/capture`).
  - `tcat` with password `blah` (can only perform analysis at `/analysis`).
- `apache.conf`: Apache Virtual Host configuration (for serving the app on URL `/`).
- `capture-script-watcher.sh`: Script for running the TCAT capture scripts every minute to make sure they are up.
- `mysql-setup.sh`: Script for executing `setup-database.sql`. Run automatically by Dockerfile's `CMD`.
- `setup-database.sql`: SQL script for creating database and database users for DMI-TCAT.
- `supervisord-capture-script-watcher.conf`: supervisord config for executing `capture-script-watcher.sh`.
