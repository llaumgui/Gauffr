<?php
/**
 * File containing the GauffrAdminAjaxView class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminAjaxView classes.
 *
 * AJAX viewer
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminAjaxView extends ezcMvcView
{
    function createZones( $layout )
    {
    	$tc = ezcTemplateConfiguration::getInstance();

        $zones = array();
        $zones[] = new ezcMvcTemplateViewHandler( 'content', 'view/full/ajax/' . strtolower($this->request->variables['function']) . '.ezt' );
        $zones[] = new ezcMvcTemplateViewHandler( 'page_layout', 'layout_ajax.ezt' );

        return $zones;
    }
}

?>