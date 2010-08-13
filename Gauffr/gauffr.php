<?php
//
// Definition of Gauffr class
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
/*! \file gauffr.php
*/


/*
 * autoload
 */
if ( !function_exists( '__autoload' ) )
{
    function __autoload( $className )
    {
        ezcBase::autoload( $className );
    }
}

/*!
  \class Gauffr gauffr.php
  \brief Gauffr primary class
 */
class Gauffr
{
    /*
     * Constantes
     */
    /* Application infos */
    const APP_NAME = "Gauffr";  // Gauffr name
    const APP_VERSION = "1.0";  // Gauffr version

    const CONF_DIR = '/etc/gauffr/';   // Gauffr configuration directory
    const GAUFFR_DB_INSTANCE = 'gauffr';  // Gauffr DB instance identifier

    /* Errors message */
    const CONFIG_ERROR_MSG = '<strong>Gauffr: Config error</strong><br />%1$s (%2$s)';
    const CONNEXION_ERROR_MSG =  '<strong>Gauffr: DB error</strong><br />%1$s (%2$s)';

    /*
     * Variables
     */
    /* Variables */
    static private $_instance = null;  // Singleton instance
    private static $_userTableSchema;  // User Table Schema
    private static $_gauffrTableSchema;  // User Table Schema

    /* Protected */
    protected $_gauffrUser;   // Gauffr user




/******************************************************************************
    Private */

    /*!
     Private constructor
     */
    private function __construct ()
    {
        $this->loadeZC();       // Load eZ Components
        $this->loadCallback();  // Load ezc Callback
        $this->loadTableSchema();       // Load ini with ezcConfigurationManager
    }



    /*!
     Load eZ Components
     */
    private function loadeZC()
    {
        /* Load eZ Comonents */
        if ( !class_exists( 'ezcBase', false ) )
            require_once 'ezc/Base/base.php';

        /* Add Gauffr to autoload */
        $gauffrPath =  dirname( __FILE__ );
        ezcBase::addClassRepository( $gauffrPath, $gauffrPath.'/autoloads' );
    }



    /*!
     Add ezc callback
     */
    private function loadCallback()
    {
        /* Callback */
        ezcBaseInit::setCallback(
            'ezcInitConfigurationManager',
            'GauffrLazyConfigurationConfiguration'
        );

        ezcBaseInit::setCallback(
            'ezcInitDatabaseInstance',
            'GauffrLazyDatabaseConfiguration'
        );
    }



    /*!
     Load ini files with eZC/Configuration
     */
    private function loadTableSchema()
    {
        $cfg = ezcConfigurationManager::getInstance();
        self::$_userTableSchema = $cfg->getSettingsInGroup('gauffr', 'UserTableSchema');
        self::$_gauffrTableSchema = $cfg->getSettingsInGroup('gauffr', 'GauffrTableSchema');
    }



    /*!
     Don't allow clone
     */
    private function __clone ()
    {
        throw new Exception ('Clone is not allowed');
    }




/******************************************************************************
    Public
*/

    /*!
     Singleton
     */
    public static function getInstance ()
    {
        try {
            if ( is_null( self::$_instance ) )
                self::$_instance = new self();

            return self::$_instance;
        }
        /* Config */
        catch(ezcConfigurationUnknownConfigException  $e) {
            die( printf( self::CONFIG_ERROR_MSG, $e->getMessage(), $e->getCode() ) );
        }
        catch(ezcConfigurationUnknownGroupException $e){
            die( printf( self::CONFIG_ERROR_MSG, $e->getMessage(), $e->getCode() ) );
        }
        catch(ezcConfigurationParseErrorException $e) {
            die( printf( self::CONFIG_ERROR_MSG, $e->getMessage(), $e->getCode() ) );
        }
        /* Database */
        catch(PDOException $e) {
            die( printf( Gauffr::CONNEXION_ERROR_MSG, $e->getMessage(), $e->getCode() ) );
        }
        catch(ezcQueryInvalidException $e ){
            die( printf( Gauffr::CONNEXION_ERROR_MSG, $e->getMessage(), $e->getCode() ) );
        }
    }



    /*!
     Identification of an user

     \param $login String User login
     \param $password String User password
     \param $alt_login String Alternative login

     \return a GauffrUser

     \TODO $alt_login
     */
    public static function fetchGauffrUser( $login, $alt_login = false )
    {
        $gauffr = self::getInstance();
        $db = ezcDbInstance::get(self::GAUFFR_DB_INSTANCE);
        $q = $db->createSelectQuery();
        $e = $q->expr;

        $q->select( '*' )->from( self::$_userTableSchema['TableName'] )
            ->leftJoin( self::$_gauffrTableSchema['TableName'],
                $q->expr->eq( self::$_userTableSchema['TableName']. '.' .self::$_userTableSchema['ID'],
                    self::$_gauffrTableSchema['TableName']. '.' .self::$_gauffrTableSchema['ID'] ) )
            ->where( $e->eq( 'binary ' . self::$_userTableSchema['Username'], $q->bindValue( $login ) ) )
            ->limit( 1 );
            $stmt = $q->prepare();
            $stmt->execute();

        if ( $stmt->rowCount() == 0 )
            return false;

        $user = $stmt->fetch();
        $gauffr->_user = new GauffrUser( $user, self::$_userTableSchema );
        return $gauffr->_user;
    }

} // EOC

?>
