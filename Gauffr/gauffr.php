<?php
/**
 * File containing the Gauffr class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The Gauffr classes called by all aplication using Gauffr.
 *
 * @version //autogentag//
 * @brief Gauffr main class
 */
class Gauffr
{
    /*
     * Constantes
     */

    /**
     * Application name.
     */
    const APP_NAME = "Gauffr";
    /**
     * Application version.
     */
    const APP_VERSION = "0.5-dev";
    /**
     * Gauffr global configuration file.
     */
    const CONF_FILE = 'gauffr';
    /**
     * Gauffr database instance identifier (for muliple usage of ezcDatabase).
     */
    const GAUFFR_DB_INSTANCE = 'gauffr';


    /*
     * Variables
     */

    /**
     * @param Gauffr Instance
     */
    static private $instance = null;
    /**
     * The GauffrUser database table Schema.
     */
    public $gauffrUserTable;
    /**
     * The Gauffr database table name.
     */
    public $gauffrTables;
    /**
     * The Gauffr debug level.
     */
    public $debugLevel;
    /**
     * The Gauffr path.
     */
    static $gauffrPath;
    /**
     * The Gauffr mapping path.
     */
    static $gauffrMappingDir;
    /**
     * The Gauffr configuration path.
     */
    static $confDir;





/* ********************************************************************* Misc */

    /**
     * Private constructor to prevent non-singleton use
     */
    private function __construct ()
    {
        /* Define path */
        Gauffr::$gauffrPath =  dirname( __FILE__ );
        Gauffr::$confDir = Gauffr::$gauffrPath . '/conf';
        Gauffr::$gauffrMappingDir =  Gauffr::$gauffrPath . '/Gauffr/lib/persistentobjectmapping/';

        $this->loadCallback(); // Load ezc Callback
        $this->loadTableSchema(); // Load ini with ezcConfigurationManager

        $cfg = ezcConfigurationManager::getInstance();
        $this->debugLevel = constant( $cfg->getSetting( 'gauffr', 'GauffrSettings', 'LogLevel' ) );
    }



    /**
     * Returns an instance of the class Gauffr.
     *
     * @return Gauffr Instance of Gauffr
     */
    public static function getInstance()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new Gauffr();
        }
        return self::$instance;
    }



    /**
     * Load database table schema from ini file.
     */
    private function loadTableSchema()
    {
        $cfg = ezcConfigurationManager::getInstance();
        $this->gauffrUserTable = $cfg->getSettingsInGroup('gauffr', 'GauffrUserTable');
        $this->gauffrTables = $cfg->getSettingsInGroup('gauffr', 'GauffrTables');

    }



    /**
     * Don't allow clone
     *
     * @throws Exception because Gauffr don't allow clone.
     */
    private function __clone ()
    {
        throw new Exception ('Clone is not allowed');
    }



    /**
     * Log event in gauffr log system
     *
     * <code>
     * Gauffr::log("Test", 'tutorial', GauffrLog::SYSTEM, array(
     *      "category" => "tutorial", "file" => __FILE__, "line" => __LINE__ )
     * );
     * </code>
     * @param string $message Message to log
     * @param string $source Source from log action
     * @param int $severity GauffrLog::INFO or GauffrLog::WARNING or GauffrLog::ERROR or GauffrLog::SYSTEM
     * @param array $attributes
     */
    public static function log( $message, $source, $severity = GauffrLog::INFO, $attributes=array( "category" => "Gauffr") )
    {
        $gauffr = self::getInstance();
        if ( $gauffr->debugLevel <= $severity )
        {
            $log = ezcLog::getInstance();
            $log->source = $source;
            $log->log( $message, $severity, $attributes );
        }
    }





/* ************************************************************ eZ Components */

    /**
     * Add eZ Components callback.
     */
    private function loadCallback()
    {
        ezcBaseInit::setCallback(
            'ezcInitConfigurationManager',
            'GauffrLazyConfigurationConfiguration'
        );
        ezcBaseInit::setCallback(
            'ezcInitDatabaseInstance',
            'GauffrLazyDatabaseConfiguration'
        );
        ezcBaseInit::setCallback(
            'ezcInitLog',
            'GauffrLazyLogConfiguration'
        );
        ezcBaseInit::setCallback(
            'ezcInitPersistentSessionInstance',
            'GauffrLazyPersistentSessionConfiguration'
        );
    }



    /**
     * Gauffr initiation
     */
    public static function gauffrInitialization()
    {
        // Load eZ Components
        if ( !defined( 'EZCBASE_ENABLED' ) )
        {
            $baseEnabled = @include 'ezc/Base/base.php';
            if ( !$baseEnabled )
            {
                $baseEnabled = include 'Base/src/base.php';
            }
            define( 'EZCBASE_ENABLED', $baseEnabled );
        }

        // Load Gauffr
        if ( !defined('GAUFFR_ENABLED') )
        {
            // autoload
            spl_autoload_register( array( 'ezcBase', 'autoload' ) );

            ezcBase::addClassRepository( dirname( __FILE__ ) );
            define( 'GAUFFR_ENABLED', true );
        }

        // Launch first instance of Gauffr
        $gauffr = Gauffr::getInstance();
    }





/* ***********************************************************    Information */

    /**
     * Return informations about Gauffr
     *
     * @param boolean $as_array Return information as array
     * @return array or stdout
     */
    public static function info( $as_array = false )
    {
        $gauffr = Gauffr::getInstance();

        $info = array(
            'version' => Gauffr::APP_VERSION,
            'info' => array(
                'Variables' => array(
                    array(
                        'Variables' => 'Gauffr::APP_NAME',
                        'Description' => 'Application name',
                        'Value' => Gauffr::APP_NAME
                    ),
                    array(
                        'Variables' => 'Gauffr::APP_VERSION',
                        'Description' => 'Application version',
                        'Value' => Gauffr::APP_VERSION
                    ),
                    array(
                        'Variables' => 'Gauffr::GAUFFR_DB_INSTANCE',
                        'Description' => 'Database instance identifier',
                        'Value' => Gauffr::GAUFFR_DB_INSTANCE
                    ),
                    array(
                        'Variables' => 'Gauffr::$debugLevel',
                        'Description' => 'Debug level',
                        'Value' => $gauffr->debugLevel
                    ),
                    array(
                        'Variables' => 'Gauffr::$gauffrPath',
                        'Description' => 'Gauffr directory',
                        'Value' => Gauffr::$gauffrPath
                    ),
                    array(
                        'Variables' => 'Gauffr::$confDir',
                        'Description' => 'Configuration directory',
                        'Value' => Gauffr::$confDir
                    ),
                    array(
                        'Variables' => 'Gauffr::$gauffrMappingDir',
                        'Description' => 'Mapping directory',
                        'Value' => Gauffr::$gauffrMappingDir
                    ),
                ),
                'Database info' => array(
                    array(
                        'Name' => 'GauffrMaster',
                        'Table name' => $gauffr->gauffrUserTable['TableName']
                    ),
                    array(
                        'Name' => 'GauffrSlave',
                        'Information' => $gauffr->gauffrTables['GauffrSlave']
                    ),
                    array(
                        'Name' => 'GauffrLog',
                        'Information' => $gauffr->gauffrTables['GauffrLog']
                    ),
                ),
                'Dependancies' => array(
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
                    /*array(
                        'Tests' => 'eZC DatabaseSchema',
                        'Result' => (class_exists('ezcDbSchema')) ? 'Pass' : 'Failed'
                    ),*/
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
                )
            )
        );

        if( $as_array )
            return $info;

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
    <style type="text/css">
        body {background-color: #ffffff; color: #000000;}
        body, td, th, h1, h2 {font-family: sans-serif;}
        pre {margin: 0px; font-family: monospace;}
        a:link {color: #000099; text-decoration: none; background-color: #ffffff;}
        a:hover {text-decoration: underline;}
        table {border-collapse: collapse;}
        .center {text-align: center;}
        .center table { margin-left: auto; margin-right: auto; text-align: left;}
        .center th { text-align: center !important; }
        td, th { border: 1px solid #000000; font-size: 75%; vertical-align: baseline;}
        h1 {font-size: 150%;}
        h2 {font-size: 125%;}
        .p {text-align: left;}
        .e {background-color: #ccccff; font-weight: bold; color: #000000;}
        .h {background-color: #9999cc; font-weight: bold; color: #000000;}
        .v {background-color: #cccccc; color: #000000;}
        .vr {background-color: #cccccc; text-align: right; color: #000000;}
        img {float: right; border: 0px;}
        hr {width: 600px; background-color: #cccccc; border: 0px; height: 1px; color: #000000;}
        </style>
    <title>Gauffr::info()</title>
    <meta name="ROBOTS" content="NOINDEX,NOFOLLOW,NOARCHIVE" />
</head>
<body>
<div id="gauffrinfo" class="center">
    <table border="0" cellpadding="3" width="600">
        <tr class="h">
            <td>
                <h1 class="p">Gauffr Version ' . Gauffr::APP_VERSION . '</h1>
            </td>
        </tr>
    </table>
    <br />';

        foreach( $info['info'] as $title => $infos )
        {
    echo '<h2><a name="' . strtolower($title) . '">' . $title . '</a></h2>
    <table width="600" cellpadding="3" border="0">
        <thead>
            <tr class="h">';
            foreach( $infos as $info )
            {
                foreach( $info as $key => $value )
                {
                    echo '<th>' . $key . '</th>';
                }
                break;
            }
            echo '</tr>
        </thead>
        <tbody>';
            foreach( $infos as $info )
            {
            echo '<tr>';
                $is_first = true;
                foreach( $info as $key => $value )
                {
                    if( $is_first )
                    {
                        $class = 'e';
                        $is_first = false;
                    }
                    else
                    {
                        $class = 'v';
                    }
                echo '<td class="' . $class . '">' . $value . '</td>';
                }
            echo '</tr>';
            }
        echo '</tbody>
    </table>
    <br />';
        }

    echo '
    </div>
</body>
</html>';
    }





/* *********************************************************** Authentication */

    /**
     * Crypt password with Gauffr method
     *
     * @TODO Allow personnal method
     *
     * @param string $password
     * @return
     */
    public static function cryptPasswd($password)
    {
        $gauffr = self::getInstance();
        $cryptoMethod = $gauffr->gauffrUserTable['CryptoMethod'];

        return $cryptoMethod($password);
    }



    /**
     * Create ezcAuthenticationDatabaseFilter
     *
     * @param ezcAuthentication &$authentication
     * @param ezcAuthenticationDatabaseFilter &$filter
     * @param string $login
     * @param string $password
     * @param boolean $login_is_alt_login The $login is an altLogin ?
     */
    public function authenticationDatabaseFilter( &$authentication, &$filter, $login, $password, $login_is_alt_login = false )
    {
        $db = ezcDbInstance::get(self::GAUFFR_DB_INSTANCE);

        if ( $login_is_alt_login )
        {
            $user = GauffrUser::fetchUserByAltLogin($login);
            if ( $user )
                $login = $user->Login;
            else
                $login = false;
        }

        $credentials = new ezcAuthenticationPasswordCredentials( $login, self::cryptPasswd($password) );
        $database = new ezcAuthenticationDatabaseInfo(
            $db,
            $this->gauffrUserTable['TableName'],
            array( $this->gauffrUserTable['Login'], $this->gauffrUserTable['Password'] )
        );

        $authentication = new ezcAuthentication( $credentials );
        $filter = new ezcAuthenticationDatabaseFilter( $database );
        $authentication->addFilter( $filter );

        $filter->registerFetchData( array(
            $this->gauffrUserTable['ID'],
            $this->gauffrUserTable['GroupID'],
            $this->gauffrUserTable['Login'],
            $this->gauffrUserTable['Mail']
        ) );
    }



    /**
     * Process Gauffr authentication with a database
     *
     * <code>
     * $user = Gauffr::authenticationDatabase(
     *      $_POST['login'],
     *      $_POST['password'],
     *      'gauffradmin'
     *      true
     * );
     * </code>
     *
     * @param string $login
     * @param string $password
     * @param string $slave_identifier
     * @param boolean $login_is_alt_login The $login is an altLogin ?
     */
    public static function authenticationDatabase( $login, $password, $slave_identifier = false, $login_is_alt_login = false )
    {
        $gauffr = self::getInstance();
        $gauffr->authenticationDatabaseFilter( $authentication, $filter, $login, $password, $login_is_alt_login );

        if ( !$authentication->run() )
        {
            Gauffr::log("Authentification failled for user \"$login\" (".$login_is_alt_login ? "AltLogin" : "Login" . ")", 'gauffr', GauffrLog::DEBUG, array( "category" => "AuthenticationDatabase", "file" => __FILE__, "line" => __LINE__ ) );
            return false;
        }

        // Create an GauffrUser
        $data =  $filter->fetchData();
        $user = new GauffrUser();
        $user->setState( array(
            'ID' => reset( $data[$gauffr->gauffrUserTable['ID']] ),
            'GroupID' => reset( $data[$gauffr->gauffrUserTable['GroupID']] ),
            'Login' => reset( $data[$gauffr->gauffrUserTable['Login']] ),
            'Mail' => reset( $data[$gauffr->gauffrUserTable['Mail']] )
        ) );

        // No slave_identifier control
        if ( !$slave_identifier )
        {
            Gauffr::log("Authentification successful for user \"$login\"", 'gauffr', GauffrLog::DEBUG, array( "category" => "AuthenticationDatabase", "file" => __FILE__, "line" => __LINE__ ) );
            return $user;
        }
        else
        {
            if ( $user->hasCredentialByIdentifier($slave_identifier) )
            {
                Gauffr::log("Authentification successful on \"$slave_identifier\" for user \"$login\"", 'gauffr', GauffrLog::DEBUG, array( "category" => "AuthenticationDatabase", "file" => __FILE__, "line" => __LINE__ ) );
                return $user;
            }
            else
            {
                Gauffr::log("User \"$login\" don't have access to \"$slave_identifier\"", 'gauffr', GauffrLog::SYSTEM, array( "category" => "AuthenticationDatabase", "file" => __FILE__, "line" => __LINE__ ) );
                return false;
            }
        }
    }
}


/*
 * Gauffr Initialization on include
 */
if ( !defined('GAUFFR_ENABLED') )
    Gauffr::gauffrInitialization();

?>
