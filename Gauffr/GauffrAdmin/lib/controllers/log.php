<?php
/**
 * File containing the logController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The logController classes.
 *
 * Gauffr log management
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class logController extends ezcMvcController
{

	/**
	 * Do log
	 */
	public function doLog()
    {

        $cfg = ezcConfigurationManager::getInstance();
        $limit = $cfg->getSetting( 'gauffr_admin', 'GauffrAdminLimit', 'Log' );
        ( isset($_GET['offset']) ) ? $offset = $_GET['offset'] : $offset = 0;

        $ret = new ezcMvcResult;
        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/log', 'Log' );
        $ret->variables['gauffrLog'] = self::doLogGetLog( $limit, $offset );
        $ret->variables['gauffrLogCount'] = self::doLogGetLogCount();
        $ret->variables['limit'] = $limit;
        $ret->variables['offset'] = $offset;

        return $ret;
    }



    /**
     * Get log
     *
     * @param int $offset
     * @param int $limit
     * @return array
     */
    private static function doLogGetLog( $limit, $offset )
    {
        return GauffrLog::fetch( false, array( 'ID', 'DESC'), array( $limit, $offset ) );
    }



    /**
     * Get log count
     *
     * @return int
     *
     * @TODO Best way for count
     */
    private static function doLogGetLogCount()
    {
        return GauffrLog::fetchCount();
    }

}

?>