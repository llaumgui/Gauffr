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
        switch ($name )
        {
            case "ga_basename":
                $def = new ezcTemplateCustomFunctionDefinition();
                $def->class = "GauffrAdminTemplateExtension";
                $def->method = "basename";
                return $def;

            case "ga_has_credential":
                $def = new ezcTemplateCustomFunctionDefinition();
                $def->class = "GauffrAdminTemplateExtension";
                $def->method = "hasCredential";
                return $def;

            case "ga_count_credential":
                $def = new ezcTemplateCustomFunctionDefinition();
                $def->class = "GauffrAdminTemplateExtension";
                $def->method = "countCredential";
                return $def;
        }

        return false;
    }



    /**
     * Check in template if a GauffrUser have credential
     *
     * @param GauffrUser $user
     * @param integer $id SlaveId
     */
    public static function hasCredential( $user, $slave_id )
    {
    	return $user->hasCredentialByID($slave_id);
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
     * Call GauffrSlave::fetchCount() for count credential where Can = 1 for
     * the slave $slave_id
     *
     * @param integer $slave_id
     */
    public static function countCredential( $slave_id )
    {
        return GauffrCredential::fetchCount( array(
            'filter' => array(
                array( 'gauffrslave_id', '=', $slave_id ),
                array( 'can', '=', 1 )
            ),
            'groupby' => 'gauffruser_id'
        ) );
    }
}
?>