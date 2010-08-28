<?php
/**
 * File containing the GauffrAdminMvcConfiguration class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
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
        $parser->prefix = preg_replace( '@/index\.php$@', '', $_SERVER['SCRIPT_NAME'] );
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
    	$routeInfo->matchedRoute = str_replace( 'index.php', '', $routeInfo->matchedRoute );
        switch ( $routeInfo->matchedRoute )
        {
            case '/':
                return new GauffrAdminRootView( $request, $result );
            case '/log':
                return new GauffrAdminLogView( $request, $result );
            case '/ERROR':
                return new GauffrAdminErrorView( $request, $result );
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
        var_dump( $request );
        $req = clone $request;
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
        $result->variables['installRoot'] = preg_replace( '@/index\.php$@', '', $_SERVER['SCRIPT_NAME'] );

        // Inject variables in $result
        $cfg = ezcConfigurationManager::getInstance();

        list( $lang ) =  $cfg->getSettingsAsList( 'gauffr_admin', 'GauffrAdminSettings',
            array( 'Language' ) );
        $result->variables['lang'] = $lang;

        list( $charset, $stylesheetsList, $javascriptsList ) =  $cfg->getSettingsAsList( 'gauffr_admin', 'GauffrAdminTemplatesSettings',
            array( 'Charset',  'StylesheetsList', 'JavascriptsList' ) );
        $result->variables['charset'] = $charset;
        $result->variables['stylesheetsList'] = $stylesheetsList;
        $result->variables['javascriptsList'] = $javascriptsList;

        $result->variables['appVersion'] = Gauffr::APP_VERSION;
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