<?php
/**
 * File containing the GauffrAdminUserCredentialController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminUserCredentialController classes.
 *
 * Gauffr users management
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminUserEditController extends ezcMvcController
{

	/**
	 * Do users
	 */
	public function doUserEdit()
    {
        $gauffrUsers = GauffrUser::fetchUserByID( (int)$_GET['userID'] );

        $ret = new ezcMvcResult;
        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/user/credential', 'User credential' );
        $ret->variables['gauffrUsers'] = $gauffrUsers;
        //$ret->variables['gauffrSlave'] = GauffrSlave::fetch( array( 'filter' => array( array( 'HasCredential', '=', 1 )) ));

        return $ret;
    }
}
?>