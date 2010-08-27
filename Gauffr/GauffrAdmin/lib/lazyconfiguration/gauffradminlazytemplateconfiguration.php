<?php
/**
 * File containing the lazy configuration for the Template eZ Components.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminLazyTemplateConfiguration classes.
 *
 * @package Gauffr
 * @version //autogentag//
 */
class GauffrAdminLazyTemplateConfiguration implements ezcBaseConfigurationInitializer
{

	public static function configureObject( $tpl )
    {
    	// Define path
        $tpl->templatePath = GAUFFR_ADMIN_TPL_PATH;
        $tpl->compilePath = GAUFFR_ADMIN_CACHE_PATH;
    }

}

?>