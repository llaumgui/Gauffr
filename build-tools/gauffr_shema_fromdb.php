#!/usr/bin/env php
<?php
/**
 * File containing the bin for clear old log.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/*
 * Check your include path.
 * If eZ Components or Gauffr is not in include path, add it:
 */
#set_include_path(get_include_path() . PATH_SEPARATOR . "/my/ezc/path/" . PATH_SEPARATOR . "/my/gauffr/path/");


/*
 * Load gauffr
 */
include 'Gauffr/gauffr.php';


/*
 * Load eZC ezcConsoleOutput
 * Configure console output and script option
 */
$db = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
$dbSchema = ezcDbSchema::createFromDb( $db );
$dbSchema->writeToFile( 'xml', '../doc/database/schema.xml' );


?>