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
    'GauffrPersistentObject' => 'lib/gauffrpersistentobject.php',
    'GauffrPersistentSessionIdentity' => 'lib/gauffrpersistentsessionidentity.php',


    /* PO */
    'GauffrCredential' => 'lib/persistentobject/gauffrcredential.php',
    'GauffrLog' => 'lib/persistentobject/gauffrlog.php',
    'GauffrUser' => 'lib/persistentobject/gauffruser.php',
    'GauffrUserExtended' => 'lib/persistentobject/gauffruserextended.php',
    'GauffrSlave' => 'lib/persistentobject/gauffrslave.php',


    /* lazyconfiguration */
    'GauffrLazyConfigurationConfiguration' => 'lib/lazyconfiguration/gauffrlazyconfigurationconfiguration.php',
    'GauffrLazyDatabaseConfiguration' => 'lib/lazyconfiguration/gauffrlazydatabaseconfiguration.php',
    'GauffrLazyLogConfiguration' => 'lib/lazyconfiguration/gauffrlazylogconfiguration.php',
    'GauffrLazyPersistentSessionConfiguration' => 'lib/lazyconfiguration/gauffrlazypersistentsessionconfiguration.php',
);

?>
