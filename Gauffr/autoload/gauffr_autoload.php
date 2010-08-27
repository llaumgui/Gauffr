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
    'GauffrPersistentObject' => 'Gauffr/lib/gauffrpersistentobject.php',
    'GauffrPersistentSessionIdentity' => 'Gauffr/lib/gauffrpersistentsessionidentity.php',


    /* PO */
    'GauffrCredential' => 'Gauffr/lib/persistentobject/gauffrcredential.php',
    'GauffrLog' => 'Gauffr/lib/persistentobject/gauffrlog.php',
    'GauffrUser' => 'Gauffr/lib/persistentobject/gauffruser.php',
    'GauffrUserExtended' => 'Gauffr/lib/persistentobject/gauffruserextended.php',
    'GauffrSlave' => 'Gauffr/lib/persistentobject/gauffrslave.php',


    /* lazyconfiguration */
    'GauffrLazyConfigurationConfiguration' => 'Gauffr/lib/lazyconfiguration/gauffrlazyconfigurationconfiguration.php',
    'GauffrLazyDatabaseConfiguration' => 'Gauffr/lib/lazyconfiguration/gauffrlazydatabaseconfiguration.php',
    'GauffrLazyLogConfiguration' => 'Gauffr/lib/lazyconfiguration/gauffrlazylogconfiguration.php',
    'GauffrLazyPersistentSessionConfiguration' => 'Gauffr/lib/lazyconfiguration/gauffrlazypersistentsessionconfiguration.php',
);

?>
