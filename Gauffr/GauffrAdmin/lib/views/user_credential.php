<?php
/**
 * File containing the GauffrAdminUsersView class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminUsersView classes.
 *
 * User credential viewer
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminUserCredentialView extends ezcMvcView
{
    function createZones( $layout )
    {
    	$tc = ezcTemplateConfiguration::getInstance();

        $zones = array();
        $zones[] = new ezcMvcTemplateViewHandler( 'menu', 'parts/menu.ezt' );
        $zones[] = new ezcMvcTemplateViewHandler( 'content', 'view/full/user_credential.ezt' );
        $zones[] = new ezcMvcTemplateViewHandler( 'page_layout', 'layout.ezt' );

        return $zones;
    }
}

?>