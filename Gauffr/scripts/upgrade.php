#!/usr/bin/env php
<?php
/**
 * File containing the php script for upgrade Gauffr DB tables.
 * Use upgrade.php --help for more informations.
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
$output->formats->motd->color = 'cyan';
$output->formats->motd->style = array( 'bold' );
$output->formats->success->color = 'green';
$output->formats->important->color = 'red';


// MOTD
$output->outputLine( 'Gauffr upgrade script', 'motd' );
$output->outputLine( '=====================' . "\n", 'motd' );

// Setup input and options
$input = new ezcConsoleInput();

$helpOption = $input->registerOption( new ezcConsoleOption( 'h', 'help' ) );
$helpOption->shorthelp = 'Show help';

$upgradeOption = $input->registerOption( new ezcConsoleOption( '', 'upgrade' ) );
$upgradeOption->shorthelp = 'Do the upgrade';

try {
    $input->process();
}
catch ( ezcConsoleOptionException $e ) {
    die( $e->getMessage() );
}


// Print help
if ( $helpOption->value !== false )
{
    $output->outputLine( 'Upgrade your Gauffr database schema.' );
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
 * upgrade
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
    $output->outputLine( 'Queries to execute to upgrade the base:' );
    foreach ( $sqlArray as $query )
    {
        $output->outputLine( "\t" . $query );
    }

    if ( $upgradeOption->value === true )
    {
        // apply the differences to the database:
        $diffSchema->applyToDB( $db );
        $output->outputLine( "\n" . 'Database is upgraded.' . "\n", 'success' );
    }
    else
    {
        $output->outputLine( "\n" . 'Need to launch upgrade.php with --upgrade option to upgrade database.' . "\n", 'important' );
    }
}
else
{
    $output->outputLine( 'Database is already upgraded.' . "\n", 'success' );
}

?>