<?php
/**
 * File containing the lazy configuration for the PersistentObject eZ Components.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrLazyPersistentSessionConfiguration classes.
 *
 * @package Gauffr
 * @version //autogentag//
 */
class GauffrLazyPersistentSessionConfiguration implements ezcBaseConfigurationInitializer
{

    /**
     * Configure the ezcPersistentSession object
     * @param string $instance DB instance name
     * @return A ezcPersistentSession instance
     */
    public static function configureObject( $instance )
    {
        $db = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);

        switch ( $instance )
        {
            case Gauffr::GAUFFR_DB_INSTANCE:
                $session = new ezcPersistentSession(
                    $db,
                    new ezcPersistentCodeManager( Gauffr::$gauffrMappingDir )
                );
        }
        return $session;
    }

}

?>