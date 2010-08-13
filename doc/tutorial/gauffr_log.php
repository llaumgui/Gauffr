<?php

if ( !@include 'Gauffr/gauffr.php' )
    include '../Gauffr/gauffr.php';

Gauffr::log("Test", 'tutorial', GauffrLog::SYSTEM, array( "category" => "tutorial", "file" => __FILE__, "line" => __LINE__ ) );

?>