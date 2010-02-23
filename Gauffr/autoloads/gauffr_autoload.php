<?php
/**
 * File containing the Gauffr components autoload.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 * @ignore
 */
return array (
    'Gauffr' => 'gauffr.php',

    /* Classes */
    'GauffrPersistentObject' => 'classes/gauffrpersistentobject.php',
    'GauffrPersistentSessionIdentity' => 'classes/gauffrpersistentsessionidentity.php',


    /* PO */
    'GauffrCredential' => 'classes/persistentobject/gauffrcredential.php',
    'GauffrLog' => 'classes/persistentobject/gauffrlog.php',
    'GauffrUser' => 'classes/persistentobject/gauffruser.php',
    'GauffrUserExtended' => 'classes/persistentobject/gauffruserextended.php',
    'GauffrSlave' => 'classes/persistentobject/gauffrslave.php',


    /* lazyconfiguration */
    'GauffrLazyConfigurationConfiguration' => 'lazyconfiguration/gauffrlazyconfigurationconfiguration.php',
    'GauffrLazyDatabaseConfiguration' => 'lazyconfiguration/gauffrlazydatabaseconfiguration.php',
    'GauffrLazyLogConfiguration' => 'lazyconfiguration/gauffrlazylogconfiguration.php',
    'GauffrLazyPersistentSessionConfiguration' => 'lazyconfiguration/gauffrlazypersistentsessionconfiguration.php',
);

?>
