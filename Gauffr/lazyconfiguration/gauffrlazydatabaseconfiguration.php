<?php
/**
 * File containing the lazy configuration for the Database eZ Components.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrLazyDatabaseConfiguration classes.
 *
 * @package Gauffr
 * @version //autogentag//
 */
class GauffrLazyDatabaseConfiguration implements ezcBaseConfigurationInitializer
{

    /**
     * Create the ezcDbFactory object
     * @param string $instance DB instance name
     * @return A ezcDbFactory instance
     */
    public static function configureObject( $instance )
    {
        switch ( $instance )
        {
            /* Gauffr DB */
            case Gauffr::GAUFFR_DB_INSTANCE:
                $cfg = ezcConfigurationManager::getInstance();
                list( $driver, $user, $password, $host, $database ) =  $cfg->getSettingsAsList( Gauffr::CONF_FILE, 'GauffrMasterDB',
                    array( 'Driver', 'User', 'Password', 'Host', 'DataBase' ) );
            break;

            /* Auther DB */
            default: // Default instance
            break;
        }

        $db = ezcDbFactory::create( "$driver://$user:$password@$host/$database" );
        $db->setAttribute( PDO::ATTR_CASE, PDO::CASE_NATURAL );
        return $db;
    }

}

?>