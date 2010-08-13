<?php
/**
 * File containing the GauffrPersistentSessionIdentity class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrPersistentSessionIdentity classes.
 *
 * Manage one instance of ezcPersistentSessionIdentityDecorator
 *
 * @package Gauffr
 * @version //autogentag//
 */
class GauffrPersistentSessionIdentity extends ezcPersistentSessionIdentityDecorator
{
    /**
     * @param Gauffr Instance
     */
    static private $instance = null;



    /**
     * Returns an instance of the class Gauffr.
     *
     * @return Gauffr Instance of Gauffr
     */
    public static function getInstance()
    {
        if ( is_null( self::$instance ) )
        {
            $persistentSession = GauffrPersistentObject::getPersistentSessionInstance();
            $identityMap = new ezcPersistentBasicIdentityMap( $persistentSession->definitionManager );
            self::$instance = new GauffrPersistentSessionIdentity( $persistentSession, $identityMap );
        }
        return self::$instance;
    }



    /**
     * Don't allow clone
     * @throws Exception because Gauffr don't allow clone.
     */
    private function __clone ()
    {
        throw new Exception ('Clone is not allowed');
    }

} 

?>