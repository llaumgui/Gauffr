<?php
/**
 * File containing the GauffrAdminRootView class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminRootView classes.
 *
 * Root of GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminRootView extends ezcMvcView
{
    function createZones( $layout )
    {
    	$tc = ezcTemplateConfiguration::getInstance();

        $zones = array();
        $zones[] = new ezcMvcTemplateViewHandler( 'menu', 'parts/menu.ezt' );
        $zones[] = new ezcMvcPhpViewHandler( 'content', $tc->templatePath . '/generic_greeting.php' );
        $zones[] = new ezcMvcTemplateViewHandler( 'page_layout', 'layout.ezt' );
        return $zones;
    }
}
?>
