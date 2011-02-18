<?php
/**
 * File containing the GauffrAdminGauffrSlaveController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminGauffrSlaveController classes.
 *
 * GauffrSlave management
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminGauffrSlaveController extends ezcMvcController
{

	/**
	 * Do users
	 */
	public function doGauffrSlave()
    {
        $cfg = ezcConfigurationManager::getInstance();
        $limit = $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminLimit', 'GauffrSlave' );
        ( isset($_GET['offset']) ) ? $offset = $_GET['offset'] : $offset = 0;


        $ret = new ezcMvcResult;
        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/gauffrslave', 'GauffrSlave' );
        $ret->variables['gauffrSlave'] = GauffrSlave::fetch( );

        return $ret;
    }
}
?>