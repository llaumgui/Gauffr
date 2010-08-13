<?php

include 'bootstrap.php';

Gauffr::log("Test", 'tutorial', GauffrLog::DEBUG, array( "category" => "tutorial", "file" => __FILE__, "line" => __LINE__ ) );

$persistentSession = GauffrLog::getPersistentSessionInstance();
$q = $persistentSession->createFindQuery('GauffrLog' );
$objects = $persistentSession->find( $q, 'GauffrLog' );
echo "<XMP>";
print_r($objects);
echo "</XMP>";
$object = null;

?>