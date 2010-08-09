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

// Load gauffr
if ( !isset($GLOBALS['GAUFFR_INIT']) || !$GLOBALS['GAUFFR_INIT'] )
    include 'Gauffr/gauffr.php';

// Get configuration
$cfg = ezcConfigurationManager::getInstance();
$ttl = $cfg->getSettings('gauffr', 'GauffrSettings', 'LogTTL');

// Load eZC ezcConsoleOutput
$output = new ezcConsoleOutput();


// Delete
$output->outputText( 'Gauffr log cleaner', 'info' );
$timeToDelete = time() - ($ttl*60*24);
$persistentSession = GauffrLog::getPersistentSessionInstance();
$q = $persistentSession->createDeleteQuery( 'GauffrLog' )
    ->where( $q->expr->lt( 'Time', $q->bindValue( $timeToDelete ) ) );
$session->deleteFromQuery( $q );
$output->outputText( 'Done', 'info' );

?>