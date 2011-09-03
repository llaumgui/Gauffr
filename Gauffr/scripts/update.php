#!/usr/bin/env php
<?php
/**
 * File containing the php script for update Gauffr DB tables.
 * Use update.php --help for mor informations.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */


/*
 * Load and configure
 */

// Load Gauffr
include 'Gauffr/gauffr.php';

// Setup output
$output = new ezcConsoleOutput();
$output->formats->info->color = 'blue';
$output->outputLine( 'Gauffr updater script.' . "\n", 'info' );

// Setup input and options
$input = new ezcConsoleInput();

$helpOption = $input->registerOption( new ezcConsoleOption( 'h', 'help' ) );
$helpOption->shorthelp = 'Show help';

$updateOption = $input->registerOption( new ezcConsoleOption( '', 'update' ) );
$updateOption->shorthelp = 'Do the update';

try {
    $input->process();
}
catch ( ezcConsoleOptionException $e ) {
    die( $e->getMessage() );
}

// Print help
if ( $helpOption->value !== false )
{
    $output->outputLine( 'Gauffr update your database schema' );
    $output->outputLine( $input->getSynopsis() );
    foreach ( $input->getOptions() as $option )
    {
        if ( $option->short != '' )
            $output->outputLine( "\t-{$option->short}/{$option->long}: {$option->shorthelp}" );
        else
            $output->outputLine( "\t{$option->long}: {$option->shorthelp}" );
    }

    exit(0);
}



/*
 * Update
 */

// Create schema from XML
$xmlSchema = ezcDbSchema::createFromFile( 'xml', 'schema.xml' );

// Create schema from DB
$db = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
$dbSchema = ezcDbSchema::createFromDb( $db );

// Filter gauffr tables from gauffr.ini
Gauffr::gauffrTablesFilter($dbSchema);

// compare the schemas:
$diffSchema = ezcDbSchemaComparator::compareSchemas( $dbSchema, $xmlSchema );

// return an array containing the differences as SQL DDL to upgrade $dbSchema
// to $xmlSchema:
if ( $sqlArray = $diffSchema->convertToDDL( $db ) )
{
    $output->outputLine( "Queries to execute to update the base:" );
    foreach ( $sqlArray as $query )
    {
        $output->outputLine( $query );
    }

    if ( $updateOption->value === true )
    {
        // apply the differences to the database:
        $diffSchema->applyToDB( $db );
        $output->outputLine( "Database is updated" );
    }
}
else
{
    $output->outputLine( "Database is already updated" );
}

?>