<?php
/**
 * File containing the errorController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The errorController classes.
 *
 * Error management in GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class errorController extends ezcMvcController
{
	/**
	 * Error view
	 */
	public function doError()
    {
        $ret = new ezcMvcResult;
        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/error', 'Error' );

        return $ret;
    }

}

?>