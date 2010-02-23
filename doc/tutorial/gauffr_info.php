<?php

if ( !isset($GLOBALS['GAUFFR_INIT']) || !$GLOBALS['GAUFFR_INIT'] )
{
    if ( !@include 'Gauffr/gauffr.php' )
        include '../Gauffr/gauffr.php';
}

Gauffr::info();

?>