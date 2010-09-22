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

        try {
            return  $session->load( 'GauffrUser', $id );
        }
        catch ( ezcPersistentObjectNotFoundException $e ) {
            return false;
        }
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

        try {
            $user =  $session->load( 'GauffrUser', $id );
        }
        catch ( ezcPersistentObjectNotFoundException $e ) {
            return false;
        }

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
        return self::fetchPersistentObject( 'GauffrUser', array(
            'filter' => array( array( 'Login', '=', $login ) )
        ) );
    }



    /**
     * Fetch user by Login
     *
     * <code>
     * $user = GauffrUser::fetchUserByAltLogin( 'TestTest' );
     * </code>
     *
     * @param string $alt_login
     * @return GauffrUser
     */
    public static function fetchUserByAltLogin($alt_login)
    {
        $extended = self::unique( self::fetchPersistentObject( 'GauffrUserExtended', array(
            'filter' => array( array( 'AltLogin', '=', $alt_login ) )
        ) ) );

        if ( !$extended )
            return false;

        $session = self::getPersistentSessionInstance();
        $user = GauffrUser::unique( $session->getRelatedObjects( $extended, 'GauffrUser' ) );
        $user->Extended = $extended;

        return $user;
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
        return self::GauffrUserExtended( 'GauffrUser', array(
            'filter' => array( array( 'Mail', '=', $mail ) )
        ) );
    }



    /**
     * Get all GauffrUser with credential relation

     * @param string $orderby
     * @return array of GauffrUserID
     */
    public static function fetchAllUserIDWithCredential( $orderby = false )
    {
    	$gauffr = Gauffr::getInstance();
    	$db = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
        $q = $db->createSelectQuery();

        if ( !$orderby )
            $orderby = $gauffr->gauffrUserTable['Login'];

        $q->select( 'u.' . $gauffr->gauffrUserTable['ID'] )
            ->from( $gauffr->gauffrUserTable['TableName'] . ' AS u' )
            ->rightJoin(
                $gauffr->gauffrTables['GauffrCredential'] . ' AS c',
                $q->expr->eq( 'u.' . $gauffr->gauffrUserTable['ID'], 'c.gauffruser_id' )
            )
            ->orderBy( 'u.' . $orderby )
            ->groupBy( 'u.' . $gauffr->gauffrUserTable['ID'] );

        $stmt = $q->prepare();
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }



    /**
     * Get all GauffrUser with extended relation

     * @param string $orderby
     * @return array of GauffrUserID
     */
    public static function fetchAllUserIDWithExtended( $orderby = false )
    {
        $gauffr = Gauffr::getInstance();
        $db = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
        $q = $db->createSelectQuery();

        if ( !$orderby )
            $orderby = $gauffr->gauffrUserTable['Login'];

        $q->select( 'u.' . $gauffr->gauffrUserTable['ID'] )
            ->from( $gauffr->gauffrUserTable['TableName'] . ' AS u' )
            ->rightJoin(
                $gauffr->gauffrTables['GauffrUserExtended'] . ' AS e',
                $q->expr->eq( 'u.' . $gauffr->gauffrUserTable['ID'], 'e.gauffruser_id' )
            )
            ->orderBy( 'u.' . $orderby )
            ->groupBy( 'u.' . $gauffr->gauffrUserTable['ID'] );

        $stmt = $q->prepare();
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
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
        $credentialArray = array();

        foreach ( $credential as $cred )
            $credentialArray[$cred->GauffrSlaveID] = $cred;

        if ( isset($credentialArray[$id]) && $credentialArray[$id]->Can )
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
        return $this->hasCredentialByID($id);
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