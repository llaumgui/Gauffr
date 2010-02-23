<?php

if ( !isset($GLOBALS['GAUFFR_INIT']) || !$GLOBALS['GAUFFR_INIT'] )
{
    if ( !@include 'Gauffr/gauffr.php' )
        include '../Gauffr/gauffr.php';
}

$persistentSession = GauffrSlave::getPersistentSessionInstance();
$q = $persistentSession->createFindQuery('GauffrSlave' );
$objects = $persistentSession->find( $q, 'GauffrSlave' );
echo "<XMP>";
print_r($objects);
echo "</XMP>";
$object = null;

echo "<hr />";

$object = GauffrSlave::unique(GauffrSlave::fetchSlaveByIdentifier( 'svn' ));
echo "<XMP>";
print_r($object);
echo "</XMP>";
$object = null;

?>