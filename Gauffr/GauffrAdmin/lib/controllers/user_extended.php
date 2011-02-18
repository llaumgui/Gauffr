<?php
/**
 * File containing the GauffrAdminUserCredentialController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminUserCredentialController classes.
 *
 * Gauffr users management
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminUserExtendedController extends ezcMvcController
{

	/**
	 * Do users
	 */
	public function doUserExtended()
    {
        $cfg = ezcConfigurationManager::getInstance();
        $limit = $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminLimit', 'Users' );
        ( isset($_GET['offset']) ) ? $offset = $_GET['offset'] : $offset = 0;

        $gauffrUsers = array();
        $ids = GauffrUser::fetchAllUserIDWithExtended();
        $i = $offset;
        while ( $i <= ($offset + $limit) )
        {
            if ( isset($ids[$i]) )
                $gauffrUsers[] = GauffrUser::fetchWithRelatedObjectsUserByID( $ids[$i][0] );
            $i++;
        }

        $ret = new ezcMvcResult;
        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/user_extended', 'User extended informations' );
        $ret->variables['gauffrUsers'] = $gauffrUsers;

        return $ret;
    }
}
?>