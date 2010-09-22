<?php
/**
 * File containing the GauffrAdminUserCredentialController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
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
class GauffrAdminUserCredentialController extends ezcMvcController
{

	/**
	 * Do users
	 */
	public function doUserCredential()
    {
        $cfg = ezcConfigurationManager::getInstance();
        $limit = $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminLimit', 'Users' );
        ( isset($_GET['offset']) ) ? $offset = $_GET['offset'] : $offset = 0;

        $gauffrUsers = array();
        $ids = GauffrUser::fetchAllUserIDWithCredential();
        $i = $offset;
    	while ( $i <= ($offset + $limit) )
    	{
    		if ( isset($ids[$i]) )
                $gauffrUsers[] = GauffrUser::fetchWithRelatedObjectsUserByID( $ids[$i][0] );
            $i++;
    	}

        $ret = new ezcMvcResult;
        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/user_credential', 'User credential' );
        $ret->variables['gauffrUsers'] = $gauffrUsers;
        $ret->variables['gauffrSlave'] = GauffrSlave::fetch( array( 'filter' => array( array( 'HasCredential', '=', 1 )) ));

        return $ret;
    }
}
?>