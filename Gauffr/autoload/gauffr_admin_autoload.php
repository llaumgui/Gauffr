<?php
/**
 * File containing the GauffrAdmin components autoload.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 * @ignore
 */
return array(

    'GauffrAdmin' => 'GauffrAdmin/lib/gauffradmin.php',
    'GauffrAdminTemplateExtension' => 'GauffrAdmin/lib/templates/gauffradmintemplateextension.php',
    'GauffrAdminI18n' => 'GauffrAdmin/lib/gauffradmini18n.php',
    'GauffrAdminMvcConfiguration' => 'GauffrAdmin/lib/gauffradminmvcconfiguration.php',
    'GauffrAdminRouter' => 'GauffrAdmin/lib/gauffradminrouter.php',
    'GauffrTemplateExtension' => 'GauffrAdmin/lib/templates/gauffrtemplateextension.php',

    /* lazyconfiguration */
    'GauffrAdminLazyTemplateConfiguration' => 'GauffrAdmin/lib/lazyconfiguration/gauffradminlazytemplateconfiguration.php',

    /* Controller */
    'GauffrAdminAjaxController' => 'GauffrAdmin/lib/controllers/ajax.php',
	'GauffrAdminDashboardController' => 'GauffrAdmin/lib/controllers/dashboard.php',
    'GauffrAdminErrorController' => 'GauffrAdmin/lib/controllers/error.php',
    'GauffrAdminLogController' => 'GauffrAdmin/lib/controllers/log.php',
    'GauffrAdminLoginController' => 'GauffrAdmin/lib/controllers/login.php',
    'GauffrAdminLogoutController' => 'GauffrAdmin/lib/controllers/logout.php',
    'GauffrAdminUserCredentialController' => 'GauffrAdmin/lib/controllers/user/credential.php',
    'GauffrAdminUserEditController' => 'GauffrAdmin/lib/controllers/user/edit.php',
	'GauffrAdminUserExtendedController' => 'GauffrAdmin/lib/controllers/user/extended.php',
	'GauffrAdminUserSearchController' => 'GauffrAdmin/lib/controllers/user/search.php',
    'GauffrAdminGauffrSlaveController' => 'GauffrAdmin/lib/controllers/gauffrslave.php',

    /* View */
    'GauffrAdminAjaxView' => 'GauffrAdmin/lib/views/ajax.php',
	'GauffrAdminErrorView' => 'GauffrAdmin/lib/views/error.php',
    'GauffrAdminLogView' => 'GauffrAdmin/lib/views/log.php',
    'GauffrAdminLoginView' => 'GauffrAdmin/lib/views/login.php',
    'GauffrAdminUserCredentialView' => 'GauffrAdmin/lib/views/user/credential.php',
    'GauffrAdminUserEditView' => 'GauffrAdmin/lib/views/user/edit.php',
	'GauffrAdminUserExtendedView' => 'GauffrAdmin/lib/views/user/extended.php',
	'GauffrAdminUserSearchView' => 'GauffrAdmin/lib/views/user/search.php',
    'GauffrAdminGauffrSlaveView' => 'GauffrAdmin/lib/views/gauffrslave.php',
    'GauffrAdminRootView' => 'GauffrAdmin/lib/views/root.php',

);

?>