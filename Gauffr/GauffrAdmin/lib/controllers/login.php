<?php
/**
 * File containing the loginController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The loginController classes.
 *
 * Login to the GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class loginController extends ezcMvcController
{

	/**
	 * Login view
	 */
	public function doLogin()
    {
        $ret = new ezcMvcResult;

        if ( !isset($_POST['login']) || !isset($_POST['login']) )
            echo 'rrr';

        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/login', 'Login' );


        return $ret;
    }

}

?>