<?php
/**
 * File containing the GauffrUser class.
 *
 * @version 0.3
 * @package Gauffr
 * @copyright Copyright (c) 2009 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrUser classes.
 *
 * Allow persistence for object GauffrUser
 *
 * @package Gauffr
 * @version 0.3
 */
class GauffrUser extends GauffrPersistentObject
{
    protected $ID;
    public $GroupID;
    public $Login;
    public $AltLogin;
    public $Mail;



    /**
     * Get PersistantObject state
     *
     * @return array
     */
    public function getState()
    {
        return array(
            "ID" => $this->ID,
            "GroupID" => $this->GroupID,
            "Login" => $this->Login,
            "AltLogin" => $this->AltLogin,
            "Mail" => $this->Mail,
        );
    }



    /**
     * fetch user by Identifiant
     *
     * @return GauffrUser
     */
    public static function fetchUserByID( $id )
    {
        $session = self::getPersistentSessionInstance();
        $user = $session->load( 'GauffrUser', $id );

        return $user;
    }



    /**
     * fetch user by Login
     *
     * @return GauffrUser
     */
    public static function fetchUserByLogin($login)
    {
        return self::fetchPersistantObjectByAttribute( 'GauffrUser', 'Login', $login );
    }



    /**
     * fetch user by Mail
     *
     * @return GauffrUser
     */
    public static function fetchUserByMail($mail)
    {
        return self::fetchPersistantObjectByAttribute( 'GauffrUser', 'Mail', $mail );
    }

} // EOC

?>