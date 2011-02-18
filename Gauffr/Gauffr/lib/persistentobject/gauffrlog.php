<?php
/**
 * File containing the GauffrLog class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrLog classes.
 *
 * @package Gauffr
 * @version //autogentag//
 */
class GauffrLog extends GauffrPersistentObject
{

	// Constant for debug level
    const DEBUG = ezcLog::DEBUG;
    const INFO = ezcLog::INFO;
    const WARNING = ezcLog::WARNING;
    const ERROR = ezcLog::ERROR;
    const SYSTEM = ezcLog::SUCCESS_AUDIT;

    // Mapping
    protected $ID;
    public $Category;
    public $File;
    public $Line;
    public $Message;
    public $Severity;
    public $Source;
    public $Time;


    /**
     * Get PersistantObject state
     *
     * @return array
     */
    public function getState()
    {
        return array(
            'ID' => $this->ID,
            'Category' => $this->Category,
            'File' => $this->File,
            'Line' => $this->Line,
            'Message' => $this->Message,
            'Severity' => $this->Severity,
            'Source' => $this->Source,
            'Time' => $this->Time,
        );
    }



    /**
     * Fetch GauffrLog
     *
     * @param array $parameters
     * @return array of GauffrSlave
     *
     * <code>
     * $logs = GauffrLog::fetch( array(
     *      'orderby' => array( 'Time', 'DESC'),
     *      'limit' => array( 10, 20 ),
     *      'filter' => array( array( 'Category', '=', 'tutorial' ) ),
     *      'groupby' => 'Source'
     * ));
     * </code>
     */
    public static function fetch( $parameters = array() )
    {
        return self::fetchPersistentObject( 'GauffrLog', $parameters );
    }



    /**
     * Count log
     *
     * @param array $parameters
     * @return integer
     *
     * <code>
     * $count = GauffrLog::fetchCount( array(
     *      'filter' => array( array( Category, '=' 'tutorial' ) )
     * ));
     * </code>
     */
    public static function fetchCount( $parameters = array() )
    {
        $gauffr = Gauffr::getInstance();
        return self::fetchCountPersistentObject( $gauffr->gauffrTables['GauffrLog'], $parameters );
    }

}

?>