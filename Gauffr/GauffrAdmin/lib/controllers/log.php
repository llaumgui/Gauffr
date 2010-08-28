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
class logController extends ezcMvcController
{

	/**
	 * Dashboard view
	 */
	public function doLog()
    {
        $ret = new ezcMvcResult;

        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/log', 'Log' );
        $ret->variables['gauffrLog'] = self::doLogGetLog(15);

        return $ret;
    }



    /**
     * Get $limit log
     *
     * @param int $limit
     * @return array
     */
    private static function doLogGetLog( $limit )
    {
    	$persistentSession = GauffrLog::getPersistentSessionInstance();
        $q = $persistentSession->createFindQuery('GauffrLog' )
            ->orderBy( 'Time', ezcQuerySelect::DESC )
            ->limit($limit, 0);

        return $persistentSession->find( $q, 'GauffrLog' );
    }

}

?>