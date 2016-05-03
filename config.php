<?php

/*
 * Database credentials
 */
$dbuser = "dmi";
$dbpass = "tcat";
$database = "twittercapture";
$hostname = "localhost";

/*
 * Capturing role(s) for DMI-TCAT
 * Here you can define which types of capturing you would like to do
 * Possible values are "track", "follow", "onepercent". 
 * Note that you can only do one of track, follow or onepercent per IP address and capturing key
 */
define("CAPTUREROLES", serialize(array(
  "track"
)));

/*
 * The user who can add and modify query bins. 
 * This user should exist in your htaccess authentication
 * Leave empty if you do not want to restrict access to the query manager - which, of course, is a security risk
 */
define("ADMIN_USER", "admin");

/*
 * *Super advanced and currently undocumented feature, leave settings as they are*
 * We have made it possible to tunnel Twitter API connections through other hosts (obtaining a different source IP address), and use multiple keysets for multiple streaming queries.
 * Each capture script should define its role, see define("CAPTUREROLES",serialize(array()))
 * Every distinct role should then get a different network path below
 * 
 */
$GLOBALS["HOSTROLE"] = array(
    'track' => "https://stream.twitter.com/",
    'follow' => "https://stream.twitter.com/",
    'onepercent' => "https://stream.twitter.com/",
);

/*
 * Mail address to report critical errors to
 */
$mail_to = "martin@westerdals.no";

/*
 * Twitter API keys (basic configuration)
 */

// Please fill in your API credentials here

$twitter_consumer_key = getenv("twitter_track_consumer_key");
$twitter_consumer_secret = getenv("twitter_track_consumer_secret");
$twitter_user_token = getenv("twitter_track_user_token");
$twitter_user_secret = getenv("twitter_track_user_secret");

// List of additional keys to loop over when there is a limited amount of requests per key, e.g. search
// twitter_keys is an array of arrays listing different Twitter API keys
$twitter_keys = array(
    array("twitter_consumer_key" => $twitter_consumer_key,
        "twitter_consumer_secret" => $twitter_consumer_secret,
        "twitter_user_token" => $twitter_user_token,
        "twitter_user_secret" => $twitter_user_secret,
    )
);

/*
 * Twitter API keys (expert configuration, with multiple roles and keys)
 *
 * Uncomment and edit code block below to activate.
 */

/**

// Make sure you have a key for each capture role defined in CAPTUREROLES above
if (!defined('CAPTURE') || !strcmp(CAPTURE, "track")) {
    $twitter_consumer_key = "";
    $twitter_consumer_secret = "";
    $twitter_user_token = "";
    $twitter_user_secret = "";
} elseif (!strcmp(CAPTURE, "follow")) {
    $twitter_consumer_key = "";
    $twitter_consumer_secret = "";
    $twitter_user_token = "";
    $twitter_user_secret = "";
} elseif (!strcmp(CAPTURE, "onepercent")) {
    $twitter_consumer_key = "";
    $twitter_consumer_secret = "";
    $twitter_user_token = "";
    $twitter_user_secret = "";
}

**/

/*
 * Klout account info (optional)
 */
$kloutapi_key = "";

/*
 * URL root in which dmi-tcats resides
 */
define('BASE_URL', getenv('tcat_base_url'));

/*
 * URL root in which analysis resides
 */
define('ANALYSIS_URL', BASE_URL . 'analysis/');

/*
 * Do you wish to enable fully automatic updates in the background? 
 */
define('AUTOUPDATE_ENABLED', false);

/*
 * Up to what complexity level do you wish to allow automatic upgrades (ie. in the background or at user request from inside the capture panel)?
 *
 * Since a lot of these updates maintain locks on the database, captures may be blocked until the upgrade has finished.
 * You may want to select a higher complexity level ONLY if you have small datasets or do not mind a temporary interruption of service.
 *
 * Legal values are: trivial, substantial, expensive
 */
define('AUTOUPDATE_LEVEL', 'trivial');

/*
 * When no database activity has occured for IDLETIME seconds during a track, the controller restarts the process. Do not set this too low,
 * as there is caching before we insert. Usually the default is fine.
 */
define('IDLETIME', 600);

/*
 * To avoid excessive verbosity, assume a minimal length of ratetime disturbance (heartbeat) in seconds
 */
define('RATELIMIT_SILENCE', 300);

/*
 * Report rate limit problems to the administrator every x hours ( 0 = no mail reporting )
 */
define('RATELIMIT_MAIL_HOURS', 24);

/*
 * Time zone
 */
date_default_timezone_set("Europe/Oslo");

/*
 * Error reporting verbosity
 */
error_reporting(E_ALL & ~E_DEPRECATED);

/*
 * How long the script is allowed to run
 */
ini_set("max_execution_time", 3600);

/*
 * How much memory the script is allowed to take
 */
ini_set("memory_limit", "2G");

/* Sysload monitoring. Display a traffic light indicating system load in the analysis panel */

define('TCAT_SYSLOAD_CHECKING', false);

/* If the sysload monitoring is enabled, a warning is issued when the sum processing time of all running tcat queries has reached the threshold below */

define('TCAT_SYSLOAD_WARNING', 20);

/* If the sysload monitoring is enabled, a blocking message is shown when the sum processing time of all running tcat queries has reached the threshold below */

define('TCAT_SYSLOAD_MAXIMUM', 55);

/*
 * Set encoding
 */
mb_internal_encoding("UTF-8");

/*
 * set location of php
 * find the location by typing 'which php' on the command line of your terminal
 */
define("PHP_CLI", "/usr/bin/php");

/*
 * Use mysql INSERT DELAYED statements to insert data into the MySQL database.
 * Recommended only for high-load sites, who may have nightly backupscripts locking database tables.
 * Make sure to adjust the MySQL server variables delayed_queue_size, max_delayed_threads to an appropriate sizes.
 * Experts only.
 */
define('USE_INSERT_DELAYED', false);

/*
 * Set to true, if you want all insert statements to fail on errors. Even though such errors are caught and reported,
 * setting this option on a production site is not recommended, since we are using multi-insert statements and all tweets
 * in such an insert will be lost on errors.
 * Developers only.
 */
define('DISABLE_INSERT_IGNORE', false);

/*
 * This is the github API URL used to check whether your current DMI-TCAT install is up-to-date (assuming you are using git).
 * You will want to change this only when you have forked the repository.
 */
define('REPOSITORY_URL', 'https://api.github.com/repos/digitalmethodsinitiative/dmi-tcat/commits');
 
?>