<?php

include 'bootstrap.php';

echo '<h1>Last Gauffr logs</h1>';


Gauffr::log("Test", 'tutorial', GauffrLog::DEBUG, array( "category" => "tutorial", "file" => __FILE__, "line" => __LINE__ ) );

$persistentSession = GauffrLog::getPersistentSessionInstance();
$q = $persistentSession->createFindQuery('GauffrLog' );
$log = $persistentSession->find( $q, 'GauffrLog' );

var_dump( $log );
$log = null;

?>