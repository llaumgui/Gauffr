<?php
/**
 * File containing the GauffrAdminLoginController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminLoginController classes.
 *
 * Login to the GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminLoginController extends ezcMvcController
{

	/**
	 * Do login view
	 */
	public function doLogin()
    {
    	if ( array_key_exists( 'gauffrAuth_redirUrl',$this->request->variables ) )
            $redirectOnLogin = $this->request->variables['gauffrAuth_redirUrl'];
        else
            $redirectOnLogin = '/';

        if ( !isset($_POST['login']) || !isset($_POST['password']) )
        {
        	$ret = new ezcMvcResult;

        	$ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/login', 'Login' );
        	$ret->variables['redirectOnLogin'] = $redirectOnLogin;

        	return $ret;
        }
        else
        {
        	$login = $_POST['login'];
        	$password = $_POST['password'];

        	$authFilter = new GauffrMvcAuthenticationFilter();
            $authFilterOptions = $authFilter->getOptions();
            $authFilterOptions->varSlaveIdentifier = 'gauffr_admin';
            $authentication = $authFilter->login( $this->request, $login, $password );

            // Bad login
	        if ( $authentication === false OR !$authentication->run() )
	        {
	        	$ret = new ezcMvcResult;
	            $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/login', 'Login' );
	            $ret->variables['redirectOnLogin'] = $redirectOnLogin;

	            return $ret;
	        }
	        else
	        {
        		$redirUrl = $_POST['redirectOnLogin'];
        		return $authFilter->returnLoginRedirect( $authentication, $this->request, $redirUrl );
	        }
        }
    }

}

?>