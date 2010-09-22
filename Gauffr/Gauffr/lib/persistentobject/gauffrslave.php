<?php
/**
 * File containing the GauffrSlave class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
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
    public $ID;
    public $Identifier;
    public $Name;
    public $Location;
    public $HasCredential;


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
            'HasCredential' => $this->HasCredential
        );
    }



    /**
     * Get ID
     *
     * @return integer
     */
    public function getID()
    {
        return $this->ID;
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