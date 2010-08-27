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

    'GauffrAdminI18n' => 'GauffrAdmin/lib/gauffradmini18n.php',
    'GauffrAdminMvcConfiguration' => 'GauffrAdmin/lib/gauffradminmvcconfiguration.php',
    'GauffrAdminRouter' => 'GauffrAdmin/lib/gauffradminrouter.php',

    /* lazyconfiguration */
    'GauffrAdminLazyTemplateConfiguration' => 'GauffrAdmin/lib/lazyconfiguration/gauffradminlazytemplateconfiguration.php',

    /* Controller */
    'dashboardController' => 'GauffrAdmin/lib/controllers/dashboard.php',

    /* View */
    'GauffrAdminRootView'         => 'GauffrAdmin/lib/views/root.php',

);
?>
