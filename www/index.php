<?php
// Include the configuration file

include '../GauffrAdmin/config.php';

$config = new helloMvcConfiguration();

// Send the configuration to the dispatcher, and run it.
$dispatcher = new ezcMvcConfigurableDispatcher( $config );
$dispatcher->run();
?>