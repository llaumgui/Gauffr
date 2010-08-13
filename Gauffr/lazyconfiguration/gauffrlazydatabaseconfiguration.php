<?php
//
// Definition of GauffrLazyDatabaseConfiguration class
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
/*! \file gauffrlazyconfigurationconfiguration.php
*/

/*!
  \class GauffrLazyDatabaseConfiguration gauffrlazyconfigurationconfiguration.php
 */
class GauffrLazyDatabaseConfiguration implements ezcBaseConfigurationInitializer
{
    public static function configureObject( $instance )
    {
        switch ( $instance )
        {
            /* Gauffr DB */
            case Gauffr::GAUFFR_DB_INSTANCE:
                $cfg = ezcConfigurationManager::getInstance();
                try {
                    list( $driver, $user, $password, $host, $database ) =  $cfg->getSettingsAsList( 'gauffr', 'GauffrDB',
                        array( 'Driver', 'User', 'Password', 'Host', 'DataBase' ) );
                }
                catch(ezcConfigurationUnknownSettingException  $e) {
                    die( printf( Gauffr::CONFIG_ERROR_MSG, $e->getMessage(), $e->getCode() ) );
                }
                try {
                    return ezcDbFactory::create( "$driver://$user:$password@$host/$database" );
                }
                catch(PDOException $e) {
                    die( printf( Gauffr::CONNEXION_ERROR_MSG, $e->getMessage(), $e->getCode() ) );
                }
                break;

            /* Auther DB */
            case false: // Default instance
                return false;
                break;
        }
    }
}

?>
