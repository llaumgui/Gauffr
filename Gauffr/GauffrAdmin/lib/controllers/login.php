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
        if ( !isset($_POST['login']) || !isset($_POST['password']) )
        {
        	$ret = new ezcMvcResult;
        	$ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/login', 'Login' );
        	return $ret;
        }
        else
        {
        	$login = $_POST['login'];
        	$password = $_POST['password'];

            $authFilter = new GauffrMvcAuthenticationFilter();
            $authentication = $authFilter->login( $this->request, $login, $password );

            // Bad login
	        if ( !$authentication->run() )
	        {
	        	$ret = new ezcMvcResult;

	            Gauffr::log("Authentification failled for user \"$login\" Login)", 'gauffr', GauffrLog::DEBUG, array( "category" => "AuthenticationDatabase", "file" => __FILE__, "line" => __LINE__ ) );
	            $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/login', 'Login' );

	            return $ret;
	        }
	        else
	        {
	        	// Redirect on login
	        	$this->request->uri = "/";
	        	return new ezcMvcInternalRedirect( $this->request );
	        }
        }
    }

}

?>