<?php
/**
 * File containing the GauffrAdminRouter class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
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

            new ezcMvcRailsRoute( '/', 'GauffrAdminDashboardController', 'dashboard' ),
            new ezcMvcRailsRoute( '/ajax/:function', 'GauffrAdminAjaxController', 'ajax' ),
            new ezcMvcRailsRoute( '/log', 'GauffrAdminLogController', 'log' ),
            new ezcMvcRailsRoute( '/gauffrslave', 'GauffrAdminGauffrSlaveController', 'gauffrSlave' ),

            // User
            new ezcMvcRailsRoute( '/user', 'GauffrAdminUserCredentialController', 'userCredential' ),
            new ezcMvcRailsRoute( '/user/credential', 'GauffrAdminUserCredentialController', 'userCredential' ),
            new ezcMvcRailsRoute( '/user/edit/:gauffrUserID', 'GauffrAdminUserEditController', 'userEdit' ),
            new ezcMvcRailsRoute( '/user/extended', 'GauffrAdminUserExtendedController', 'userExtended' ),
            new ezcMvcRailsRoute( '/user/search', 'GauffrAdminUserSearchController', 'userSearch' ),

            // System
            new ezcMvcRailsRoute( '/ERROR', 'GauffrAdminErrorController', 'error' ),
            new ezcMvcRailsRoute( '/login', 'GauffrAdminLoginController', 'login' ),
            new ezcMvcRailsRoute( '/logout', 'GauffrAdminLogoutController', 'logout' ),
        );
    }
}
?>