<?php
/**
 * File containing the GauffrUser class.
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
class GauffrUser extends GauffrPersistentObject
{
    protected $ID;
    public $GroupID;
    public $Login;
    public $Mail;



    /**
     * Get PersistantObject state
     *
     * @return array
     */
    public function getState()
    {
        return array(
            'ID' => $this->ID,
            'GroupID' => $this->GroupID,
            'Login' => $this->Login,
            'Mail' => $this->Mail,
        );
    }





/* ******************************************************************** Fetch */

    /**
     * Fetch user by Identifiant
     *
     * @param mixed $id
     * @return GauffrUser
     */
    public static function fetchUserByID( $id )
    {
        $identitySession = self::ezcPersistentSessionIdentityDecorator();
        return $identitySession->load( 'GauffrUser', $id );
    }



    /**
     * Fetch user by Login
     *
     * @param string $login
     * @return GauffrUser
     */
    public static function fetchUserByLogin($login)
    {
        return self::fetchPersistantObjectByAttribute( 'GauffrUser', 'Login', $login );
    }



    /**
     * Fetch user by Mail
     *
     * @param string $mail
     * @return GauffrUser
     */
    public static function fetchUserByMail($mail)
    {
        return self::fetchPersistantObjectByAttribute( 'GauffrUser', 'Mail', $mail );
    }





/* *************************************************************** Credential */

    /**
     * Get credential for a GauffrUser
     *
     * @return Array of GauffrCredential
     */
    public static function getCredential( GauffrUser $gauffrUser )
    {
        $identitySession = self::ezcPersistentSessionIdentityDecorator();
        try {
            return $identitySession->getRelatedObjects( $gauffrUser, 'GauffrCredential' );
        }
         catch (ezcPersistentIdentityMissingException $e) {
             return array();
         }

    }



    /**
     * The GauffrUser has access to GauffrSlave ?
     *
     * @param $id
     * @return boolean
     */
    public function hasCredentialByID( $id )
    {
        $credential = self::getCredential( $this );
        if ( isset($credential[$id]) && $credential[$id]->Can )
            return true;
        else
            return false;
    }



    /**
     * The GauffrUser has access to GauffrSlave ?
     *
     * @param $id
     * @return boolean
     */
    public function hasCredentialByIdentifier( $identifier )
    {
        $credential = self::getCredential( $this );

        if ( empty($credential) )
            return false;

        $gauffrslave = GauffrUser::unique(GauffrSlave::fetchSlaveByIdentifier($identifier));

        if ( !$gauffrslave )
            return false;

        $id = $gauffrslave->getID();

        if ( isset($credential[$id]) && $credential[$id]->Can )
            return true;
        else
            return false;
    }

} // EOC

?>