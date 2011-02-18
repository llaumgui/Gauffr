<?php
/**
 * File containing the lazy configuration for the Template eZ Components.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
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

	public static function configureObject( $cfg )
    {
    	// Define path
        $cfg->templatePath = GAUFFR_ADMIN_TPL_PATH;
        $cfg->compilePath = GAUFFR_ADMIN_CACHE_PATH;

        $cfg->context = new ezcTemplateXhtmlContext();

        // Translation
        $manager = GauffrAdminI18n::getManager();
        $locale = GauffrAdminI18n::getLocale();
        $cfg->translation = ezcTemplateTranslationConfiguration::getInstance();
        $cfg->translation->manager = $manager;
        $cfg->translation->locale = $locale;
        $cfg->addExtension( "GauffrAdminTemplateExtension" );

    }

}

?>