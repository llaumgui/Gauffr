<?php
/**
 * File containing the GauffrAdminI18n class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
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
        $this->currentLanguage = $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminSettings', 'Locale' );

    	$this->backend = new ezcTranslationTsBackend( dirname( __FILE__ ). '/../translations' );
        $this->backend->setOptions( array( 'format' => 'translation-[LOCALE].ts' ) );

        $this->manager = new ezcTranslationManager( $this->backend );
        $this->manager->addFilter( ezcTranslationComplementEmptyFilter::getInstance() );
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
     *
     * @param string $context Translation context
     * @param string $string String to translate
     * @param array $params Pass parameter to translation
     *
     * @return String translated
     */
    public static function getTranslation( $context, $string, $params = false )
    {
    	$i18n = self::getInstance();
        $context = $i18n->manager->getContext( $i18n->currentLanguage, $context );

        if ( !$params )
            return $context->getTranslation( $string );
        else
            return $context->getTranslation( $string, $params );
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



    /**
     * Load localized javascript
     *
     * @param string $js
     *
     * @return string
     */
    public static function JavascriptsLocalizer( $js )
    {
        $i18n = self::getInstance();
        $locale = explode('_', $i18n->currentLanguage);

        $js = str_replace('%LOCALE%', $locale[0], $js);

        return $js;
    }

}

?>