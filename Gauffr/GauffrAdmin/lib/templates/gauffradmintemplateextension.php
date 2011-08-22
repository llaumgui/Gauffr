<?php
/**
 * File containing the GauffrAdminTemplateExtension class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminTemplateExtension classes.
 *
 * Provide template function use by GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminTemplateExtension implements ezcTemplateCustomFunction
{
    /**
     * Return a ezcTemplateCustomFunctionDefinition for the given function $name.
     *
     * @param string $name
     * @return ezcTemplateCustomFunctionDefinition
     */
    public static function getCustomFunctionDefinition( $name )
    {
        $def = new ezcTemplateCustomFunctionDefinition();

        switch ($name)
        {
            case 'build_css_list':
                $def->class = 'GauffrAdminTemplateExtension';
                $def->method = 'buildStylesheetsList';
                break;

            case 'build_js_list':
                $def->class = 'GauffrAdminTemplateExtension';
                $def->method = 'buildJavascriptsList';
                break;

            case 'ga_basename':
                $def->class = 'GauffrAdminTemplateExtension';
                $def->method = 'basename';
                break;

            default:
                return false;
        }

        return $def;
    }



    /**
     * Provide php basename function in eZC Template
     *
     * @param string $path
     */
    public static function basename( $path )
    {
        return basename( $path );
    }



    /**
     * Build stylesheets URL list using minify
     *
	 * @return array
     */
    public static function buildStylesheetsList()
    {
        $cfg = ezcConfigurationManager::getInstance();
        $stylesheetsList = $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminTemplatesSettings', 'StylesheetsList' );

        // Use minify
        if ( $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminTemplatesSettings', 'MinifyStylesheets' ) === true )
        {
            return array( GauffrAdmin::getInstallRoot() . 'media/min/f=' . implode( $stylesheetsList, ',') );
        }
        // Don't use minify
        else
        {
            $stylesheetsListArray = array();
            foreach ( $stylesheetsList as $css)
            {
                $stylesheetsListArray[] = GauffrAdmin::getInstallRoot() . 'media/' . $css;
            }
            return $stylesheetsListArray;
        }
    }



    /**
     * Build Javascript URL list using minify
     *
	 * @return array
     */
    public static function buildJavascriptsList()
    {
        $cfg = ezcConfigurationManager::getInstance();
        $javascriptsList = $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminTemplatesSettings', 'JavascriptsList' );

        // Use minify
        if ( $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminTemplatesSettings', 'MinifyStylesheets' ) === true )
        {
            return array( GauffrAdmin::getInstallRoot() . 'media/min/f=' . implode( $javascriptsList, ',') );
        }
        // Don't use minify
        else
        {
            $javascriptsListArray = array();
            foreach ( $javascriptsList as $js)
            {
                $javascriptsListArray[] = GauffrAdmin::getInstallRoot() . 'media/' . $js;
            }
            return $javascriptsListArray;
        }
    }
}

?>