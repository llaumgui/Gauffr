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
 * The GauffrUser classes.
 *
 * Allow persistence for object GauffrUser
 *
 * @package Gauffr
 * @version //autogentag//
 */
class GauffrUserExtended extends GauffrPersistentObject
{
    protected $ID;
    public $Can;
    public $GauffrUserID;



    /**
     * Get PersistantObject state
     *
     * @return array
     */
    public function getState()
    {
        return array(
            'ID' => $this->ID,
            'Can' => $this->Can,
            'GauffrUserID' => $this->GauffrUserID
        );
    }

} // EOC

?>