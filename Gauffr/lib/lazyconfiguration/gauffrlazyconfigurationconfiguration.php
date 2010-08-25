<?php
/**
 * File containing the lazy configuration for the Configuration components.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrLazyConfigurationConfiguration classes.
 *
 * Lazy configuration for Configuration Components.
 *
 * @version //autogentag//
 * @brief Lazy configuration for Configuration
 */
class GauffrLazyConfigurationConfiguration implements ezcBaseConfigurationInitializer
{

    /**
     * Configure the ezcConfigurationIniReader object
     * @param $cfg
     */
    public static function configureObject( $cfg )
    {
        $cfg->init( 'ezcConfigurationIniReader', Gauffr::$confDir );
    }

}

?>