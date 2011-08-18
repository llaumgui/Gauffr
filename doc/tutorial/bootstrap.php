<?php

/*
 * Check your include path.
 * If eZ Components or Gauffr is not in include path, add it:
 */
set_include_path(get_include_path() . PATH_SEPARATOR . "/my/ezc/path/" . PATH_SEPARATOR . "/my/gauffr/path/");

if ( !defined('GAUFFR_LOADED') OR !GAUFFR_LOADED )
    require ('Gauffr/gauffr.php' );

?>