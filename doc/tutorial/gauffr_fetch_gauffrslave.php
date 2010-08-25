<?php

include 'bootstrap.php';

/*
 * GauffrSlave is a eZC Persistent Object
 */
$persistentSession = GauffrSlave::getPersistentSessionInstance();
$q = $persistentSession->createFindQuery('GauffrSlave' );
$slave = $persistentSession->find( $q, 'GauffrSlave' );

echo 'All GauffrSlaves';
var_dump( $slave );

echo "<hr />";
$slave = null;



/*
 * You can fetch GauffrSlave by Identifier
 */
$slave = GauffrSlave::unique(GauffrSlave::fetchSlaveByIdentifier( 'svn' ));

echo 'Get GauffrSlave by identifier';
var_dump( $slave );

echo "<hr />";
$slave = null;

?>