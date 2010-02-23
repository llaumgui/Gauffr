<?php
/**
 * File containing the GauffrLog class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
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

    const DEBUG = ezcLog::DEBUG;
    const INFO = ezcLog::INFO;
    const WARNING = ezcLog::WARNING;
    const ERROR = ezcLog::ERROR;
    const SYSTEM = ezcLog::SUCCESS_AUDIT;

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
        );
    }

}

?>