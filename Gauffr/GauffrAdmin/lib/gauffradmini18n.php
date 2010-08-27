<?php
/**
 * File containing the GauffrAdminI18n class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminI18n classes.
 *
 * Manage eZC Translation singleton
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminI18n
{
    /**
     * @param GauffrAdminI18n Instance
     */
    static private $instance = null;
    /**
     * ezcTranslationTsBackend
     */
    private $backend;
    /**
     * ezcTranslationManager
     */
    private $manager;
    /**
     * ezcTranslationManager
     */
    private $currentLanguage;



    /**
     * Private constructor to prevent non-singleton use
     */
    private function __construct ()
    {
        $cfg = ezcConfigurationManager::getInstance();
        $this->currentLanguage = $cfg->getSetting( 'gauffr_admin', 'GauffrAdminSettings', 'Locale' );

    	$this->backend = new ezcTranslationTsBackend( dirname( __FILE__ ). '/../translations' );
        $this->backend->setOptions( array( 'format' => 'translation-[LOCALE].xml' ) );

        $this->manager = new ezcTranslationManager( $this->backend );
    }



    /**
     * Returns an instance of the class Gauffr.
     *
     * @return Gauffr Instance of Gauffr
     */
    private static function getInstance()
    {
        if ( is_null( self::$instance ) )
        {
            self::$instance = new GauffrAdminI18n();
        }
        return self::$instance;
    }


    /**
     * Get translation for $string in $context
     * Enter description here ...
     * @param string $context Translation context
     * @param string $string String to translate
     *
     * @return String translated
     */
    public static function getTranslation( $context, $string )
    {
    	$i18n = self::getInstance();
        $context = $i18n->manager->getContext( $i18n->currentLanguage, $context );
        return $context->getTranslation( $string );
    }



    /**
     * ezcTranslationManager accessor
     *
     * @return ezcTranslationManager
     */
    public static function getManager()
    {
        $i18n = self::getInstance();
        return $i18n->manager;
    }



    /**
     * Locale accessor
     *
     * @return string
     */
    public static function getLocale()
    {
        $i18n = self::getInstance();
        return $i18n->currentLanguage;
    }

}

?>