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
    // Mapping
    protected $ID;
    public $GroupID;
    public $Login;
    public $Mail;

    // Related Objects
    public $Credential = array();
    public $Extended = array();



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



    /**
     * Get prefetched relation
     *
     * @return array
     */
    private static function getPrefetchRelations()
    {
        return array(
            'GauffrCredential' =>  new ezcPersistentRelationFindDefinition(
                'GauffrCredential'
            ),
            'GauffrUserExtended' =>  new ezcPersistentRelationFindDefinition(
                'GauffrUserExtended'
            )
        );
    }





/* ******************************************************************** Fetch */

    /**
     * Fetch user by ID
     *
     * <code>
     * $user = GauffrUser::fetchUserByID( 1 );
     * </code>
     * @param mixed $id
     * @return GauffrUser
     */
    public static function fetchUserByID( $id )
    {
        $session = self::getPersistentSessionInstance();

        return $session->load( 'GauffrUser', $id );
    }



    /**
     * Fetch user by ID with all related objects
     *
     * @param mixed $id
     * @return GauffrUser
     */
    public static function fetchWithRelatedObjectsUserByID( $id )
    {
        $session = self::getPersistentSessionInstance();

        $user =  $session->load( 'GauffrUser', $id );

        /* Add RO */
        $user->Credential = $user->getCredential();
        $user->Extended = $user->getExtended();

        return $user;
    }



    /**
     * Fetch user by Login
     *
     * <code>
     * $user = GauffrUser::fetchUserByLogin( 'test' );
     * </code>
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
     * <code>
     * $user = GauffrUser::fetchUserByLogin( 'test@test.com' );
     * </code>
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
    public function getCredential()
    {
        /* 1: Try to load session identity */
        $identitySession = self::getPersistentSessionIdentity();
        try {
            return $identitySession->getRelatedObjects( $this, 'GauffrCredential' );
        }

        /* 2: Use query */
        catch (ezcPersistentIdentityMissingException $e) {
             $session = self::getPersistentSessionInstance();
             return $session->getRelatedObjects( $this, 'GauffrCredential' );
        }
    }



    /**
     * The GauffrUser has access to GauffrSlave by GauffrSlave's identifier ?
     *
     * @param $id
     * @return boolean
     */
    public function hasCredentialByID( $id )
    {
        $credential = $this->getCredential();
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
        $credential = $this->getCredential();

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





/* ***************************************************************** Extended */

    /**
     * Get GauffrUser extended informations
     *
     * @return array
     */
    public function getExtended()
    {
        /* 1: Try to load session identity */
        $identitySession = self::getPersistentSessionIdentity();
        try {
            $extended = $identitySession->getRelatedObjects( $this, 'GauffrUserExtended' );
            return reset($extended);
        }

        /* 2: Use query */
        catch (ezcPersistentIdentityMissingException $e) {
            $session = self::getPersistentSessionInstance();
            $extended = $session->getRelatedObjects( $this, 'GauffrUserExtended' );
            return reset($extended);
        }
    }

}

?>