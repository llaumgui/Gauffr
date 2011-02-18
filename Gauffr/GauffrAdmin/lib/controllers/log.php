<?php
/**
 * File containing the GauffrAdminLogController class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminLogController classes.
 *
 * Gauffr log management
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminLogController extends ezcMvcController
{

	/**
	 * Do log
	 */
	public function doLog()
    {

        $cfg = ezcConfigurationManager::getInstance();
        $limit = $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminLimit', 'Log' );
        ( isset($_GET['offset']) ) ? $offset = $_GET['offset'] : $offset = 0;
        ( isset($_GET['category']) ) ? $category = $_GET['category'] : $category = "";
        ( isset($_GET['severity']) ) ? $severity = $_GET['severity'] : $severity = "";
        ( isset($_GET['source']) ) ? $source = $_GET['source'] : $source = "";

        $parameters = array(
            'category' => $category,
            'severity' => $severity,
            'source' => $source
        );

        $ret = new ezcMvcResult;
        $ret->variables['pageName'] = GauffrAdminI18n::getTranslation( 'view/log', 'Log' );

        $ret->variables['gauffrLog'] = self::doLogGetLog( $limit, $offset, $parameters );
        $ret->variables['gauffrLogCount'] = self::doLogGetLogCount( $parameters );

        $ret->variables['gauffrLogCategory'] = self::doLogGetLogCategory();
        $ret->variables['gauffrLogSource'] = self::doLogGetLogSource();
        $ret->variables['gauffrLogSeverity'] = self::doLogGetLogSeverity();

        $ret->variables['getCategory'] = $category;
        $ret->variables['getSeverity'] = $severity;
        $ret->variables['getSource'] = $source;

        $ret->variables['limit'] = $limit;
        $ret->variables['offset'] = $offset;

        return $ret;
    }



    /**
     * Get log
     *
     * @param int $offset
     * @param int $limit
     * @param array $filters
     * @return array
     */
    private static function doLogGetLog( $limit, $offset, $filters )
    {
    	$filterArray = array();
    	foreach ( $filters as $filter => $value )
    	{
            if ( !empty($value) )
                $filterArray[] = array( $filter, '=', $value );
    	}

    	return GauffrLog::fetch( array(
            'filter' => $filterArray,
            'orderby' => array( 'Time', 'DESC'),
            'limit' => array( $limit, $offset )
        ));
    }



    /**
     * Get log count
     *
     * @param array $filters
     *
     * @return int
     */
    private static function doLogGetLogCount( $filters )
    {
        $filterArray = array();
        foreach ( $filters as $filter => $value )
        {
            if ( !empty($value) )
                $filterArray[] = array( $filter, '=', $value );
        }

        return GauffrLog::fetchCount( array(
            'filter' => $filterArray
        ));
    }



    /**
     * Get log severity
     *
     * @return int
     *
     * @TODO Best way for count
     */
    private static function doLogGetLogSeverity()
    {
        return GauffrLog::fetch( array(
            'orderby' => array( 'Severity', 'ASC'),
            'groupby' => 'Severity'
        ));
    }



    /**
     * Get log category
     *
     * @return int
     *
     * @TODO Best way for count
     */
    private static function doLogGetLogCategory()
    {
        return GauffrLog::fetch( array(
            'orderby' => array( 'Category', 'ASC'),
            'groupby' => 'Category'
        ));
    }



    /**
     * Get log source
     *
     * @return int
     *
     * @TODO Best way for count
     */
    private static function doLogGetLogSource()
    {
        return GauffrLog::fetch( array(
            'orderby' => array( 'Source', 'ASC'),
            'groupby' => 'Source'
        ));
    }

}

?>