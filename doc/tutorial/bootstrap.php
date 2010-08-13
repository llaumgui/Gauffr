<?php

if ( !defined('GAUFFR__ENABLED') )
{
    /*
     * Check your include path.
     * If eZ Components or Gauffr is not in include path, add it:
     */
    #set_include_path(get_include_path() . PATH_SEPARATOR . "/my/ezc/path/" . PATH_SEPARATOR . "/my/gauffr/path/");
    set_include_path(get_include_path() . PATH_SEPARATOR . "D:\wamp\www\ezpublish-4.3\lib\ezc" . PATH_SEPARATOR . "../../");

    include ('Gauffr/gauffr.php' );
}

?>