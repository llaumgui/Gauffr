<?php
/**
 * File containing the GauffrAdminTemplateExtension class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
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
        switch ($name )
        {
            case "ga_basename":
                $def = new ezcTemplateCustomFunctionDefinition();
                $def->class = "GauffrAdminTemplateExtension";
                $def->method = "basename";

                return $def;
        }

        return false;
    }



    /**
     * Provide php basename function in eZC Template
     *
     * @param string $path
     */
    public static function basename( $path )
    {
        // Implementation.

        return basename( $path );
    }
}
?>