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
    protected $ID;
    public $Identifier;
    public $Name;
    public $Location;


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
            'Location' => $this->Location
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
        return self::fetchPersistantObjectByAttribute( 'GauffrSlave', 'Identifier', $identifier );
    }

}

?>