<?php
/**
 * File containing the lazy configuration for the Log eZ Components.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrLazyDatabaseConfiguration classes.
 *
 * @package Gauffr
 * @version //autogentag//
 */
class GauffrLazyLogConfiguration implements ezcBaseConfigurationInitializer
{

    /**
     * Create the ezcDbFactory object
     * @param string $log DB instance name
     */
    public static function configureObject( $log )
    {
        $db = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
        $gauffr = Gauffr::getInstance();
        $writer = new ezcLogDatabaseWriter( $db, $gauffr->gauffrTables['GauffrLog'] );
        $log->getMapper()->appendRule( new ezcLogFilterRule( new ezcLogFilter, $writer, true ) );
    }

}

?>