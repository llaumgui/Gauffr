<?php
/**
 * File containing the GauffrAdminUserSearchController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminUserSearchController classes.
 *
 * Gauffr users search
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminUserSearchController extends ezcMvcController
{

	/**
	 * Do users
	 */
	public function doUserSearch()
    {
    	// Return
        $ret = new ezcMvcResult;

        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/user/search', 'Search user' );

        return $ret;
    }
}
?>