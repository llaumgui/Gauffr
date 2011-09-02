#!/usr/bin/env php
<?php
/**
 * Load Gauffr shema from DB and write in documentation.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */


// Load gauffr
include 'Gauffr/gauffr.php';

$db = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
$dbSchema = ezcDbSchema::createFromDb( $db );
$dbSchema->writeToFile( 'xml', '../Gauffr/scripts/schema.xml' );

?>