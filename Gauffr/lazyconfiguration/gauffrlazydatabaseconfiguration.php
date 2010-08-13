<?php
/**
 * File containing the lazy configuration for the Database eZ Components.
 *
 * @version 0.3
 * @package Gauffr
 * @copyright Copyright (c) 2009 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrLazyDatabaseConfiguration classes.
 *
 * @package Gauffr
 * @version 0.3
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

        return ezcDbFactory::create( "$driver://$user:$password@$host/$database" );
    }

}

?>