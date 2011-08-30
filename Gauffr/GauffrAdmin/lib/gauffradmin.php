<?php
/**
 * File containing the GauffrAdmin class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdmin class.
 *
 * @version //autogentag//
 * @brief GauffrAdmin main class
 */
class GauffrAdmin
{
    /*
     * Constantes
     */

    /**
     * Application name.
     */
    const APP_NAME = 'GauffrAdmin';
    /**
     * GauffrAdmin global configuration file.
     */
    const CONF_FILE = 'gauffr_admin';
    /**
     * GauffrAdmin slave identifier
     */
    const SLAVE_IDENTIFIER = 'gauffr_admin';

    /**
     * @param Gauffr Instance
     */
    static private $instance = null;

    /**
     * GauffrAdmin root directory
     */
    private $installRoot = false;



    /**
     * Private constructor to prevent non-singleton use
     */
    private function __construct ()
    {
        /* Define path */
        $this->installRoot = preg_replace( '@/index\.php$@', '', $_SERVER['SCRIPT_NAME'] );
    }



    /**
     * Returns an instance of the class Gauffr.
     *
     * @return Gauffr Instance of Gauffr
     */
    public static function getInstance()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new GauffrAdmin();
        }
        return self::$instance;
    }


    /**
     * Return the GauffrAdmin root directory
     *
     * @return string GauffrAdmin root directory
     */
    public static function getInstallRoot()
    {
        return self::getInstance()->installRoot . '/';
    }


    /**
     * Build a GauffrAdmin URL.
     * Used by template or by system.
     *
     * @param string $uri
     */
    public static function buildURL( $uri = '' )
    {
        if ( strpos($uri, '/') === 0 )
            $uri = substr($uri, 1);
        return self::getInstallRoot() . $uri;
    }

}

?>