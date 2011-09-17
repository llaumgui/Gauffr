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
$output->formats->title->color = 'cyan';
$output->formats->title->style = array( 'bold', 'underlined' );
$output->formats->success->color = 'green';
$output->formats->important->color = 'red';
$output->formats->fatal->color = 'red';


// Motd
$output->outputLine( 'Gauffr install script', 'motd' );
$output->outputLine( '=====================' . "\n", 'motd' );


// Setup input and options
$input = new ezcConsoleInput();

$helpOption = $input->registerOption( new ezcConsoleOption( 'h', 'help' ) );
$helpOption->shorthelp = 'Show help';

try {
    $input->process();
}
catch ( ezcConsoleOptionException $e ) {
    die( $e->getMessage() );
}


// Print help
if ( $helpOption->value !== false )
{
    $output->outputLine( 'Install Gauffr and GauffrAdmin on your system.' );
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



/**
 * Ask to user if he want continue.
 *
 * @param ezcConsoleOutput &$output
 */
function askToContinue ( ezcConsoleOutput &$output )
{
    $question = ezcConsoleQuestionDialog::YesNoQuestion(
        $output,
        'Do you want to continue ?',
        'y'
    );

    while ( ( $choice = ezcConsoleDialogViewer::displayDialog( $question ) ) )
    {
        if ( $choice != 'y' AND $choice != 'Y' )
            exit();
        break;
    }
}



/*
 * Step #0: Warning
 */
$output->outputLine( 'Before continuing, make sure that "gauffr.ini" and "gauffr_admin.ini" are well configured', 'important' );
askToContinue($output);



/*
 * Step #1: Check dependancies
 */
$output->outputLine( "\n\n" . 'Step #1: Check dependancies' . "\n", 'title' );
$dependancies = array(
    array(
        'Tests' => 'Dependancies',
        'Result' => 'Result'
    ),
    array(
        'Tests' => 'php > 5.2',
        'Result' => (version_compare(PHP_VERSION, '5.2.0', '>=')) ? 'Pass' : 'Failed'
    ),
    array(
        'Tests' => 'eZC Authentication',
        'Result' => (class_exists('ezcAuthentication')) ? 'Pass' : 'Failed'
    ),
    array(
        'Tests' => 'eZC AuthenticationDatabaseTiein',
        'Result' => (class_exists('ezcAuthenticationDatabaseInfo')) ? 'Pass' : 'Failed'
    ),
    array(
        'Tests' => 'eZC Configuration',
        'Result' => (class_exists('ezcConfiguration')) ? 'Pass' : 'Failed'
    ),
    array(
        'Tests' => 'eZC ConsoleTools',
        'Result' => (class_exists('ezcConsoleOption')) ? 'Pass' : 'Failed'
    ),
    array(
        'Tests' => 'eZC Database',
        'Result' => (class_exists('ezcDbInstance')) ? 'Pass' : 'Failed'
    ),
    array(
        'Tests' => 'eZC DatabaseSchema',
        'Result' => (class_exists('ezcDbSchema')) ? 'Pass' : 'Failed'
    ),
    array(
        'Tests' => 'eZC EventLog',
        'Result' => (class_exists('ezcLog')) ? 'Pass' : 'Failed'
    ),
    array(
        'Tests' => 'eZC EventLogDatabaseTiein',
        'Result' => (class_exists('ezcLogDatabaseWriter')) ? 'Pass' : 'Failed'
    ),
    array(
        'Tests' => 'eZC PersistentObject',
        'Result' => (class_exists('ezcPersistentSession')) ? 'Pass' : 'Failed'
    )
);

$table = new ezcConsoleTable( $output, 78 );
$table->options->defaultBorderFormat = 'normalBorder';
$table[0]->borderFormat = 'headBorder';
$table[0]->format = 'headContent';
$table[0]->align = ezcConsoleTable::ALIGN_CENTER;
foreach ( $dependancies as $row => $cells )
{
    $i = 0;
    foreach ( $cells as $cell )
    {
        if ( $cell == 'Pass' )
            $table[$row][$i]->format = 'success';
        elseif ( $cell == 'Failed' )
            $table[$row][$i]->format = 'important';

        $table[$row][$i]->content = $cell;

        $i++;
    }
}
$table->outputTable();
$output->outputLine( "\n" );
askToContinue($output);



/*
 * Step #2: Check DB connection
 */
$output->outputLine( "\n\n" . 'Step #2: Connect to DB' . "\n", 'title' );
try {
    ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
    $output->outputLine( 'Pass', 'success' );
}
catch (Exception $e) {
    $output->outputLine( $e->getMessage() . "\n", 'fatal' );
}
askToContinue($output);



/*
 * Step #3: Get GauffrAdmin administrator
 */
$output->outputLine( "\n\n" . 'Step #3: Get login for Gauffr Administrator' . "\n", 'title' );

$question = new ezcConsoleQuestionDialog( $output );
$question->options->text = "Please enter the administrator's login ?";
$question->options->showResults = true;

while ( $choice = ezcConsoleDialogViewer::displayDialog( $question ) )
{
    if ( !( $gauffrUser = GauffrUser::fetchUserByLogin($choice) ) )
    {
        $output->outputLine( '"' . $choice . '" is not a valid user !', 'important' );
    }
    else
    {
        $gauffrUser = GauffrUser::unique($gauffrUser);
        $output->outputLine( "\n" . 'Give admin rights to "' . $gauffrUser->Login . '" ?', 'success' );
        askToContinue($output);
        break;
    }

}


/*
 * Step #4: Install Gauffr database
 */
$output->outputLine( "\n\n" . 'Step #4: Install Gauffr database' . "\n", 'title' );

// Create schema from XML
$xmlSchema = ezcDbSchema::createFromFile( 'xml', 'schema.xml' );

// Create schema from DB
$db = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
$xmlSchema->writeToDb( $db );

// Create GauffrAdmin GauffrSlave
$output->outputLine( "\n" . 'Create "gauffr_admin" GauffrSlave', 'info' );
try {
    $session = GauffrSlave::getPersistentSessionInstance();
    $gauffrAdmin = new GauffrSlave();
    $gauffrAdmin->HasCredential = 1;
    $gauffrAdmin->Identifier = 'gauffr_admin';
    $gauffrAdmin->Name = 'GauffrAdmin';
    $gauffrAdmin->Location = 'http://localhost/gauffradmin';
    $session->save($gauffrAdmin);
    $output->outputLine( 'Pass', 'success' );

}
catch (Exception $e) {
    $output->outputLine( $e->getMessage() . "\n", 'fatal' );
}

// Give admin rights
$output->outputLine( "\n" . 'Give admin rights to "' . $gauffrUser->Login . '"', 'info' );
try {
    $session = GauffrCredential::getPersistentSessionInstance();
    $gauffrCredential = new GauffrCredential();
    $gauffrCredential->GauffrUserID = $gauffrUser->getID();
    $gauffrCredential->GauffrSlaveID = 1;
    $gauffrCredential->Can = 1;
    $session->save($gauffrCredential);
    $output->outputLine( 'Pass', 'success' );
}
catch (Exception $e) {
    $output->outputLine( $e->getMessage() . "\n", 'fatal' );
}

$output->outputLine( "\n" );
$output->outputLine( 'Gauffr and GauffrAdmin are properly installed', 'success' );

?>