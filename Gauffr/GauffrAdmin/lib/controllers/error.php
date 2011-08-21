<?php
/**
 * File containing the GauffrAdminErrorController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminErrorController classes.
 *
 * Error management in GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminErrorController extends ezcMvcController
{
	/**
	 * Do error
	 */
	public function doError()
    {
        $ret = new ezcMvcResult;

        $errorMessages = array();
        if ( isset( $GLOBALS['DEBUG_ERROR_MESSAGES'] ) )
            $errorMessages = $GLOBALS['DEBUG_ERROR_MESSAGES'];

        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/error', 'Error' );
        $ret->variables['errorMessages'] = $errorMessages;

        return $ret;
    }

}

?>