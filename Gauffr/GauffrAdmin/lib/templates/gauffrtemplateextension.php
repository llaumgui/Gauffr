<?php
/**
 * File containing the GauffrTemplateExtension class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrTemplateExtension classes.
 *
 * Provide template Gauffr's functions use by GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrTemplateExtension implements ezcTemplateCustomFunction
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
            case 'ga_has_credential':
                $def->class = 'GauffrTemplateExtension';
                $def->method = 'hasCredential';
                break;

            case "ga_count_credential":
                $def->class = 'GauffrTemplateExtension';
                $def->method = 'countCredential';
                break;

            default:
                return false;
        }

        return $def;
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