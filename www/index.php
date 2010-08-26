<?php
/**
 * GauffrAdmin index.php.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

// Include the configuration file
include 'GauffrAdmin/bootstrap.php';

// Instantiate the dispatcher configuration object.
$config = new GauffrAdminMvcConfiguration();

// Send the configuration to the dispatcher, and run it.
$dispatcher = new ezcMvcConfigurableDispatcher( $config );
$dispatcher->run();

?>