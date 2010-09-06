<?php
/**
 * File containing the GauffrMvcAuthenticationFilterOptions class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrMvcAuthenticationFilterOptions classes.
 *
 * Provide options for GauffrMvcAuthenticationFilter components
 *
 * @package Gauffr
 * @version //autogentag//
 *
 * @property ezcDbInstance $database      The database that is used for the user database.
 * @property string $varNameFilter        The name of the variable under which the auth filter is available in the controller's actions.
 * @property string $varNameUserName      The name of the variable under which the user name will be provided in the controller's actions.
 * @property string $varNameUserId        The name of the variable under which the user ID will be provided in the controller's actions.
 * @property string $sessionUserIdKey     The name of the session variable that contains the user ID.
 * @property string $sessionTimestampKey  The name of the session variable that contains the last-accessed timestamp.
 * @property string $loginRequiredUri     The URI that the filter will be redirected to when authentication is required.
 * @property string $logoutUri            The URI that the filter will be redirected to when he runs the logout action.
 *
 * @package MvcAuthenticationTiein
 * @version //autogen//
 */
class GauffrMvcAuthenticationFilterOptions extends ezcBaseOptions
{
    /**
     * Constructs an object with the specified values.
     *
     * @throws ezcBasePropertyNotFoundException
     *         if $options contains a property not defined
     * @throws ezcBaseValueException
     *         if $options contains a property with a value not allowed
     * @param array(string=>mixed) $options
     */
    public function __construct( array $options = array() )
    {
        $this->database = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);

        $this->varNameFilter   = 'ezcAuth_filter';
        $this->varNameUserName = 'ezcAuth_user_name';
        $this->varNameUserId   = 'ezcAuth_user_id';

        $this->sessionUserIdKey = 'ezcAuth_id';
        $this->sessionTimestampKey = 'ezcAuth_timestamp';

        $this->loginRequiredUri = '/login';
        $this->logoutUri = '/';

        parent::__construct( $options );
    }

    /**
     * Sets the option $name to $value.
     *
     * @throws ezcBasePropertyNotFoundException
     *         if the property $name is not defined
     * @throws ezcBaseValueException
     *         if $value is not correct for the property $name
     * @param string $name
     * @param mixed $value
     * @ignore
     */
    public function __set( $name, $value )
    {
        switch ( $name )
        {
            case 'database':
                if ( !$value instanceof ezcDbHandler )
                {
                    throw new ezcBaseValueException( $name, $value, 'ezcDbInstance' );
                }
                $this->properties[$name] = $value;
                break;
            case 'varNameFilter':
            case 'varNameUserName':
            case 'varNameUserId':
            case 'sessionUserIdKey':
            case 'sessionTimestampKey':
            case 'loginRequiredUri':
            case 'logoutUri':
                if ( !is_string( $value ) )
                {
                    throw new ezcBaseValueException( $name, $value, 'string' );
                }
                $this->properties[$name] = $value;
                break;

            default:
                throw new ezcBasePropertyNotFoundException( $name );
        }
    }
}

?>