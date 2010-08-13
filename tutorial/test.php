<?php

//if ( !@include 'Gauffr/gauffr.php' )
    include '../Gauffr/gauffr.php';

$user = Gauffr::fetchGauffrUser( 'test');
print_r($user);

?>