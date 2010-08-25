<?php
/**
 * File containing the GauffrCredential class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrCredential classes.
 *
 * Allow persistence for object GauffrCredential.
 *
 * @version //autogentag//
 * @brief GauffrCredential persistant object
 */
class GauffrCredential extends GauffrPersistentObject
{
	// Mapping
    protected $ID;
    public $GauffrUserID;
    public $GauffrSlaveID;
    public $Can;



    /**
     * Get PersistantObject state
     *
     * @return array
     */
    public function getState()
    {
        return array(
            'ID' => $this->ID,
            'GauffrUserID' => $this->GauffrUserID,
            'GauffrSlaveID' => $this->GauffrSlaveID,
            'Can' => $this->Can,
        );
    }

}

?>