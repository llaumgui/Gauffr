<?php
/**
 * File containing the GauffrAdmin components autoload.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 * @ignore
 */
return array(

    'GauffrAdminMvcConfiguration' => 'lib/gauffradminmvcconfiguration.php',
    'GauffrAdminRouter' => 'lib/gauffradminrouter.php',

    /* lazyconfiguration */
    'GauffrAdminLazyTemplateConfiguration' => 'lib/lazyconfiguration/gauffradminlazytemplateconfiguration.php',

    /* Controller */
    'dashboardController' => 'lib/controllers/dashboard.php',

    /* View */
    'GauffrAdminRootView'         => 'lib/views/root.php',

);
?>
