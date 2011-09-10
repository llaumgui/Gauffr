<?php
/**
 * File containing the GauffrSlave class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrSlave classes.
 *
 * Allow persistence for object GauffrSlave
 *
 * @package Gauffr
 * @version //autogentag//
 */
class GauffrSlave extends GauffrPersistentObject
{
    public $ID; /* @TODO: public for tpl access, set protected */
    public $Identifier;
    public $Name;
    public $Location;
    public $HasCredential;
    public $GauffrCredential;


    /**
     * Get PersistantObject state
     *
     * @return array
     */
    public function getState()
    {
        return array(
            'ID' => $this->ID,
            'Identifier' => $this->Identifier,
            'Name' => $this->Name,
            'Location' => $this->Location,
            'HasCredential' => $this->HasCredential,
        	'GauffrCredential' => $this->GauffrCredential
        );
    }



    /**
     * Fetch GauffrSlave by ID
     *
     * <code>
     * $gauffrSlave = GauffrSlave::fetchGauffrSlaveByID( 1 );
     * </code>
     *
     * @param mixed $id
     *
     * @return GauffrSlave
     */
    public static function fetchGauffrSlaveByID( $id )
    {
        return self::fetchByID( 'GauffrSlave', $id);
    }



    /**
     * fetch user by Login
     *
     * @return GauffrSlave
     */
    public static function fetchSlaveByIdentifier($identifier)
    {
        return self::fetch( array(
            'filter' => array( array( 'Identifier', '=', $identifier ) )
        ) );
    }



    /**
     * Fetch GauffrSlave
     *
     * @param array $parameters
     * @return array of GauffrSlave
     *
     * <code>
     * $slave = GauffrSlave::fetch( array(
     *      'orderby' => array( 'ID', 'DESC'),
     *      'limit' => array( 10, 20 )
     * ));
     * </code>
     */
    public static function fetch( $parameters = array() )
    {
        return self::fetchPersistentObject( 'GauffrSlave', $parameters );
    }

}

?>