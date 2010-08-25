#!/usr/bin/env php
<?php
/**
 * File containing the script for prune old log.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/*
 * Load gauffr
 */
include 'Gauffr/gauffr.php';


/*
 * Load eZC ezcConsoleOutput
 * Configure console output and script option
 */
// Setup output
$output = new ezcConsoleOutput();
$output->formats->info->color = 'blue';
$output->outputLine( 'Gauffr log cleaner' . "\n", 'info' );

// Setup input and options
$input = new ezcConsoleInput();

$helpOption = $input->registerOption( new ezcConsoleOption( 'h', 'help' ) );
$helpOption->shorthelp = 'Show help';

$ttlOption = $input->registerOption( new ezcConsoleOption(
    't', 'ttl',
    ezcConsoleInput::TYPE_INT
) );
$ttlOption->shorthelp = 'Time to life for log, in day';

try {
    $input->process();
}
catch ( ezcConsoleOptionException $e ) {
    die( $e->getMessage() );
}

// Print help
if ( $helpOption->value !== false )
{
    $output->outputLine( 'Gauffr log cleaner prune old GauffrLog from your database' );
    $output->outputLine( $input->getSynopsis() );
    foreach ( $input->getOptions() as $option )
         $output->outputLine( "\t-{$option->short}/{$option->long}: {$option->shorthelp}\n" );
    exit(0);
}


/*
 * Clean log
 */

// Get TTL
if ( $ttlOption->value !== false )
    $ttl = $ttlOption->value;
else
{
    // Get TTL from Gauffr configuration
    $cfg = ezcConfigurationManager::getInstance();
    $ttl = intval( $cfg->getSetting('gauffr', 'GauffrSettings', 'LogTTL') );
}

// Calculate time to deletion
$timeToDelete = new DateTime();
$timeToDelete->modify('-' . intval($ttl) . ' day');
$timeToDelete = $timeToDelete->format('Y-m-d');

$output->outputLine( 'Start to clean log older than ' . $ttl .' days (' . $timeToDelete . ')' );

// Delete
$persistentSession = GauffrLog::getPersistentSessionInstance();
$q = $persistentSession->createDeleteQuery( 'GauffrLog' );
$q->where( $q->expr->lt( 'Time', $q->bindValue( $timeToDelete ) ) );
$persistentSession->deleteFromQuery( $q );

$output->outputLine( 'Done', 'info' );

?>