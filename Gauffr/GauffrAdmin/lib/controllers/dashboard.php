<?php
/**
 * File containing the GauffrAdminDashboardController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminDashboardController classes.
 *
 * Dashboard of GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminDashboardController extends ezcMvcController
{

	/**
	 * Do dashboard
	 */
	public function doDashboard()
    {
        $ret = new ezcMvcResult;
        $ret->variables['gauffrInfo'] = Gauffr::info(true);
        $ret->variables['gauffrLog'] = self::doDashboardGetLastLog(5);
        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/dashboard', 'Dashboard' );

        return $ret;
    }



    /**
     * Get $limit last log
     *
     * @param int $limit
     * @return array
     */
    private static function doDashboardGetLastLog( $limit )
    {
    	$persistentSession = GauffrLog::getPersistentSessionInstance();
        $q = $persistentSession->createFindQuery('GauffrLog' )
            ->orderBy( 'Time', ezcQuerySelect::DESC )
            ->limit($limit, 0);

        return $persistentSession->find( $q, 'GauffrLog' );
    }

}

?>