<?php
/**
 * File containing the dashboardController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The dashboardController classes.
 *
 * Dashboard of GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class dashboardController extends ezcMvcController
{
	/**
	 * Dashboard view
	 */
	public function doDashboard()
    {
        $ret = new ezcMvcResult;
        $ret->variables['gauffrInfo'] = Gauffr::info(true);
        $ret->variables['gauffrLog'] = self::getLastLog(5);
        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/dashboard', 'Dashboard' );

        return $ret;
    }


    private static function getLastLog( $limit )
    {
    	$persistentSession = GauffrLog::getPersistentSessionInstance();
        $q = $persistentSession->createFindQuery('GauffrLog' )
            ->orderBy( 'Time', ezcQuerySelect::DESC )
            ->limit($limit, 0);

        return $persistentSession->find( $q, 'GauffrLog' );
    }

}
?>
