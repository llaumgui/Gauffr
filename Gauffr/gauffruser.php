<?php
//
// Definition of GauffrUser class
//
// Created on: <25-Feb-2009 19:00:00 bf>
//
// SOFTWARE NAME: Gauffr (Gestion de l'Authentification Unifiée Fedora FR )
// SOFTWARE RELEASE: 0.1
// BUILD VERSION:
// COPYRIGHT NOTICE: Copyright (c) 2009 Guillaume Kulakowski and contributors
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//
/*! \file gauffruser.php
*/

/*!
  \class GauffrUser gauffruser.php
  \brief GauffrUser
 */
class GauffrUser
{
    public $ID;
    public $GroupID;
    public $Login;
    public $Username;
    public $CryptedPassword;
    public $CryptedMethod;
    public $Mail;
    public $gauffrAcces = array();


    public function __construct( $sqlinfo, $schema)
    {
        $this->ID = $sqlinfo[$schema['ID']];
        $this->GroupID = $sqlinfo[$schema['GroupID']];
        $this->Login = $sqlinfo[$schema['Username']];
        $this->Username = &$this->Login;
        $this->CryptedPassword = $sqlinfo[$schema['Password']];
        $this->CryptedMethod = $schema['CryptoMethod'];
        $this->Mail = $sqlinfo[$schema['Mail']];
    }



    /*!
     Check PAssword identification for a GauffrUser

     \param $password String User password

     \return Boolean True is password is right
     */
    public function checkPassword( $password )
    {
        $cryptFunction = $this->CryptedMethod;
        if ( $this->CryptedPassword == $cryptFunction($password) )
            return true;
        return false;
    }

} // EOC

?>
