<?php
/**
 * File containing the GauffrAdminRouter class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminRouter classes.
 *
 * Manage the MVC router configuration of GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminRouter extends ezcMvcRouter
{
    public function createRoutes()
    {
        return array(

            new ezcMvcRailsRoute( '/log', 'logController', 'log' ),
            new ezcMvcRailsRoute( '/', 'dashboardController', 'dashboard' ),

            // System
            new ezcMvcRailsRoute( '/ERROR', 'errorController', 'error' ),
        );
    }
}
?>