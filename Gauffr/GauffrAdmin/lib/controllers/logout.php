<?php
/**
 * File containing the GauffrAdminLogoutController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminLogoutController classes.
 *
 * Logout from the GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminLogoutController extends ezcMvcController
{

	/**
	 * Do logout
	 */
	public function doLogout()
    {
    	$prefix = preg_replace( '@/index\.php$@', '', $_SERVER['SCRIPT_NAME'] );
    	$options = new GauffrMvcAuthenticationFilterOptions();
        $options->logoutUri = $prefix . '/';
        $authFilter = new GauffrMvcAuthenticationFilter( $options );
        $authFilter->logout($this->request);

        // Redirect on logout
        return $authFilter->returnLogoutRedirect($this->request);
    }

}

?>