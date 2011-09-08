<?php
/**
 * File containing the GauffrAdminMvcConfiguration class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrAdminMvcConfiguration classes.
 *
 * Manage the MVC configuration of GauffrAdmin
 *
 * @package GauffrAdmin
 * @version //autogentag//
 */
class GauffrAdminMvcConfiguration implements ezcMvcDispatcherConfiguration
{

    /**
     * Creates the request parser able to produce a relevant request object
     * for this session.
     *
     * @return ezcMvcRequestParser
     */
    function createRequestParser()
    {
        $parser = new ezcMvcHttpRequestParser;
        $parser->prefix = GauffrAdmin::getInstallRoot(false);

        return $parser;
    }



    /**
     * Create the router able to instantiate a relevant controller for this
     * request.
     *
     * @param ezcMvcRequest $request
     *
     * @return GauffrAdminRouter
     */
    function createRouter( ezcMvcRequest $request )
    {
        return new GauffrAdminRouter( $request );
    }



    /**
     * Creates the view handler that is able to process the result.
     *
     * @param ezcMvcRoutingInformation $routeInfo
     * @param ezcMvcRequest $request
     * @param ezcMvcResult $result
     *
     * @return ezcMvcView
     */
    function createView( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request, ezcMvcResult $result )
    {
        switch ( str_replace( 'index.php', '', $routeInfo->matchedRoute ) )
        {
            // Misc
            case '/':
                return new GauffrAdminRootView( $request, $result );
            case '/ajax/:function':
                return new GauffrAdminAjaxView( $request, $result );
            case '/log':
                return new GauffrAdminLogView( $request, $result );

            // GauffrSlave
            case '/gauffrslave':
                return new GauffrAdminGauffrSlaveView( $request, $result );
            case '/gauffrslave/add':
                return new GauffrAdminGauffrSlaveCRUDView( $request, $result );
            case '/gauffrslave/edit/:gauffrSlaveID':
                return new GauffrAdminGauffrSlaveCRUDView( $request, $result );

            // User
            case '/user':
                return new GauffrAdminUserCredentialView( $request, $result );
            case '/user/credential':
                return new GauffrAdminUserCredentialView( $request, $result );
            case '/user/edit/:gauffrUserID':
                return new GauffrAdminUserEditView( $request, $result );
            case '/user/extended':
                return new GauffrAdminUserExtendedView( $request, $result );
            case '/user/search':
                return new GauffrAdminUserSearchView( $request, $result );

            // System
            case '/ERROR':
                return new GauffrAdminErrorView( $request, $result );
            case '/login':
                return new GauffrAdminLoginView( $request, $result );

        }
    }



    /**
     * Creates a response writer that uses the response and sends its
     * output.
     *
     * This method should be able to pick different response writers, but the
     * response writer itself will only know about the $response.
     *
     * @param ezcMvcRoutingInformation $routeInfo
     * @param ezcMvcRequest $request
     * @param ezcMvcResult $result
     * @param ezcMvcResponse $response
     *
     * @return ezcMvcResponseWriter
     */
    function createResponseWriter( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request, ezcMvcResult $result, ezcMvcResponse $response )
    {
        return new ezcMvcHttpResponseWriter( $response );
    }



    /**
     * Create the default internal redirect object in case something goes
     * wrong in the views.
     *
     * @param ezcMvcRequest $request
     * @param ezcMvcResult  $result
     * @param Exception     $e
     *
     * @return ezcMvcRedirect
     */
    function createFatalRedirectRequest( ezcMvcRequest $request, ezcMvcResult $result, Exception $response )
    {
        $req = clone $request;
        $cfg = ezcConfigurationManager::getInstance();

        if ( $cfg->getSetting( GauffrAdmin::CONF_FILE, 'GauffrAdminSettings', 'Debug' ) == true )
        {
            $GLOBALS['DEBUG_DUMP'] = array(
                'request' => $request,
            	'result' => $result,
            	'response' => $response
            );
            $GLOBALS['DEBUG_ERROR_MESSAGES'] = array();
            if ( isset( $response->errorMessage ) )
                $GLOBALS['DEBUG_ERROR_MESSAGES'][] = $response->errorMessage;
            if ( isset( $response->originalMessage ) )
                $GLOBALS['DEBUG_ERROR_MESSAGES'][] = $response->originalMessage;
        }

        $req->uri = '/ERROR';
        return $req;
    }



    /**
     * Runs all the pre-routing filters that are deemed necessary depending on
     * information in $request.
     *
     * The pre-routing filters could modify the request data so that a
     * different router can be chosen.
     *
     * @param ezcMvcRequest $request
     */
    function runPreRoutingFilters( ezcMvcRequest $request )
    {
    }



    /**
     * Runs all the request filters that are deemed necessary depending on
     * information in $routeInfo and $request.
     *
     * This method can return an object of class ezcMvcInternalRedirect in case
     * the filters require this. A reason for this could be in case an
     * authentication filter requires authentication credentials to be passed
     * in through a login form. The method can also not return anything in case
     * no redirect is necessary.
     *
     * @param ezcMvcRoutingInformation $routeInfo
     * @param ezcMvcRequest $request
     *
     * @return ezcMvcInternalRedirect|null
     */
    function runRequestFilters( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request )
    {

        $auth = new GauffrMvcAuthenticationFilter();

    	switch ( $routeInfo->matchedRoute )
        {
	        case '/login-required':
	        case '/login':
	        case '/logout':
	        case '/error':
	            break;
	        default:
	            return $auth->runAuthRequiredFilter( $request );
        }
    }



    /**
     * Runs all the request filters that are deemed necessary depending on
     * information in $routeInfo, $request and $result.
     *
     * @param ezcMvcRoutingInformation $routeInfo
     * @param ezcMvcRequest $request
     * @param ezcMvcResult $result
     */
    function runResultFilters( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request, ezcMvcResult $result )
    {
        // Inject configuration in $result
        $cfg = ezcConfigurationManager::getInstance();

        list( $lang ) =  $cfg->getSettingsAsList(
            GauffrAdmin::CONF_FILE,
            'GauffrAdminSettings',
            array( 'Language' )
        );
        list( $charset ) =  $cfg->getSettingsAsList(
            GauffrAdmin::CONF_FILE,
            'GauffrAdminTemplatesSettings',
            array( 'Charset' )
        );

        // Inject informations in $result
        $result->variables['lang'] = $lang;
        $result->variables['charset'] = $charset;
        $result->variables['matchedRoute'] = $routeInfo->matchedRoute;

        // Inject session informations in $result
        $options = new ezcAuthenticationSessionOptions();
        $options->idKey = 'gauffrAuth_id';
        $options->timestampKey = 'gauffrAuth_timestamp';
        $session = new ezcAuthenticationSession($options);
        $result->variables['username'] = $session->load();
    }



    /**
     * Runs all the request filters that are deemed necessary depending on
     * information in $routeInfo, $request, $result and $response.
     *
     * @param ezcMvcRoutingInformation $routeInfo
     * @param ezcMvcRequest $request
     * @param ezcMvcResult  $result
     * @param ezcMvcResponse $response
     */
    function runResponseFilters( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request, ezcMvcResult $result, ezcMvcResponse $response )
    {
    }
}

?>