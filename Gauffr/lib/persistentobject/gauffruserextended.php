<?php
/**
 * File containing the GauffrUserExtended class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrUserExtended classes.
 *
 * Allow persistence for object GauffrCredential
 *
 * @package Gauffr
 * @version //autogentag//
 */
class GauffrUserExtended extends GauffrPersistentObject
{
	// Mapping
    protected $ID;
    public $AltLogin;



    /**
     * Get PersistantObject state
     *
     * @return array
     */
    public function getState()
    {
        return array(
            'ID' => $this->ID,
            'AltLogin' => $this->AltLogin,
        );
    }

}

?>