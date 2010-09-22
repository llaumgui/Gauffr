<?php
/**
 * File containing the GauffrAdminLoginController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
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
    	$prefix = preg_replace( '@/index\.php$@', '', $_SERVER['SCRIPT_NAME'] );

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
            $authentication = $authFilter->login( $this->request, $login, $password );

            // Bad login
	        if ( !$authentication->run() )
	        {
	        	$ret = new ezcMvcResult;

	            Gauffr::log("Authentification failled for user \"$login\"", 'gauffr', GauffrLog::DEBUG, array( "category" => "AuthenticationDatabase", "file" => __FILE__, "line" => __LINE__ ) );
	            $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/login', 'Login' );
	            $ret->variables['redirectOnLogin'] = $redirectOnLogin;

	            return $ret;
	        }
	        else
	        {
                $user = GauffrUser::unique( GauffrUser::fetchUserByLogin($login) );

                // Don't have access
                if ( !$user->hasCredentialByIdentifier( GauffrAdmin::SLAVE_IDENTIFIER ) )
	        	{
	        		$ret = new ezcMvcResult;

                    Gauffr::log("User \"$login\" don't have access to slave \"" . GauffrAdmin::SLAVE_IDENTIFIER . "\"", 'gauffr', GauffrLog::DEBUG, array( "category" => "AuthenticationDatabase", "file" => __FILE__, "line" => __LINE__ ) );
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

}

?>