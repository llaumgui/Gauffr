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
            case 'build_javascript':
                $def->class = 'GauffrAdminTemplateExtension';
                $def->method = 'buildJavascript';
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



    /*public static function buildJavascript()
    {
        $cfg = ezcConfigurationManager::getInstance();

        $javascriptsList = $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminTemplatesSettings', 'JavascriptsList' );
        return '<script type="text/javascript" src="' . GauffrAdmin::getInstallRoot() . '"media/min/f=' . implode( $javascriptsList, ',') . '"><!-- --></script>';
    }*/
}
?>