<?php
/**
 * File containing the GauffrAdminAjaxController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminAjaxController classes.
 *
 * Gauffr AJAX
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminAjaxController extends ezcMvcController
{

	/**
	 * Do AJAX
	 *
	 * @return ezcMvcResult
	 */
	public function doAjax()
    {
        // Call the function passed to the controller
        return call_user_func( array($this, $this->function) );
    }



    /**
     * AJAX function who search a GauffrUser
	 *
	 * @return ezcMvcResult
     */
	private function searchUser()
    {
        $ret = new ezcMvcResult;
        $ret->variables['gauffrUsers'] = GauffrUser::findUser($_POST['q']);

        return $ret;
    }
}

?>