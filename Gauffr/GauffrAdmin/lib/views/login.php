<?php
/**
 * File containing the GauffrAdminLogView class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminLogView classes.
 *
 * Log viewer
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminLoginView extends ezcMvcView
{
    function createZones( $layout )
    {
    	$tc = ezcTemplateConfiguration::getInstance();

        $zones = array();
        $zones[] = new ezcMvcTemplateViewHandler( 'content', 'view/full/login.ezt' );
        $zones[] = new ezcMvcTemplateViewHandler( 'page_layout', 'layout_login.ezt' );

        return $zones;
    }
}

?>