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
	 * Do error
	 */
	public function doError()
    {
        $ret = new ezcMvcResult;
        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/error', 'Error' );

        // Degug information
        $action = false;
        $request = false;
        $router = false;

        $cfg = ezcConfigurationManager::getInstance();
        if ( $cfg->getSetting( 'gauffr_admin', 'GauffrAdminSettings', 'Debug' ) )
        {
            $action = $this->action;
            $request = $this->request;
            $router = $this->getRouter();

        }

        $ret->variables['action'] = $action;
        $ret->variables['request'] = $request;
        $ret->variables['router'] = $router;

        return $ret;
    }

}

?>