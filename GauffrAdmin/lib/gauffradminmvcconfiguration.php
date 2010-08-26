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
     * We start with the createRequestParser() method, which is required to
     * return a request parser object that will be used to gather information
     * from the environment. We're going to write a web site, so we're going to
     * use the ezcMvcHttpRequestParser class. The method creates a parser object,
     * and then we set the prefix to the directory in which the application is
     * run
     *
     * @see MvcTools/interfaces/ezcMvcDispatcherConfiguration::createRequestParser()
     */
    function createRequestParser()
    {
        $parser = new ezcMvcHttpRequestParser;
        $parser->prefix = preg_replace( '@/index\.php$@', '', $_SERVER['SCRIPT_NAME'] );
        return $parser;
    }



    /**
     * After the dispatcher created an ezcMvcRequest object with the request
     * parser, it creates a router object through the createRouter() method.
     * This method accepts the created ezcMvcRequest object so that it could
     * chose a different router depending on information contained in the request
     * object.
     *
     * @see MvcTools/interfaces/ezcMvcDispatcherConfiguration::createRouter()
     *
     * @param ezcMvcRequest $request
     * @return GauffrAdminRouter
     */
    function createRouter( ezcMvcRequest $request )
    {
        return new GauffrAdminRouter( $request );
    }



    /**
     * We'll create the router object itself as first thing after the rest of
     * the dispatcher configuration. We will create two routes, "/" for a general
     * "Hello World" greeting and "/" + name for a personalized greeting. The
     * router and dispatcher will find a controller, execute the action and
     * return a result in the form of an ezcMvcResult object. This object
     * needs to be processed with view handlers. View handlers are selected by
     * returning a specific view class from the createView() method of the
     * dispatcher configuration. For each of the two routes, we create a view.
     * We can do that by using the 'matchedRoute' property of the route
     * information object, which is also passed as argument to the createView()
     * method.
     *
     * @see MvcTools/interfaces/ezcMvcDispatcherConfiguration::createView()
     *
     * @param ezcMvcRoutingInformation $routeInfo
     * @param ezcMvcRequest $request
     * @param ezcMvcResult $result
     *
     * @return object
     */
    function createView( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request, ezcMvcResult $result )
    {
        switch ( $routeInfo->matchedRoute )
        {
            case '/':
                return new GauffrAdminRootView( $request, $result );

            /* case '/:name':
                return new helloNameView( $request, $result );
            case '/downloadTest':
                return new helloTestView( $request, $result ); */
        }
    }



    /**
     * After the view has rendered the result, the rendered result needs to be
     * transported back to the client. In order to select such a response writer,
     * the dispatcher calls the createResponseWriter() method. In our case we're
     * only interested in HTTP and therefore we'll just select the
     * ezcMvcHttpResponseWriter as you can see in the implementation of this
     * method.
     *
     * @see MvcTools/interfaces/ezcMvcDispatcherConfiguration::createResponseWriter()
     *
     * @param ezcMvcRoutingInformation $routeInfo
     * @param ezcMvcRequest $request
     * @param ezcMvcResult $result, ezcMvcResponse $response
     *
     * @return ezcMvcHttpResponseWriter
     */
    function createResponseWriter( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request, ezcMvcResult $result, ezcMvcResponse $response )
    {
        return new ezcMvcHttpResponseWriter( $response );
    }



    /**
     * The last method that we use, is the createFatalRedirectRequest() method.
     * This method is called by the configurable dispatcher when no route could
     * be found by the router, or when the view rendering threw an Exception.
     * The purpose of the createFatalRedirectRequest() method is to reconstruct
     * a new ezcMvcRequest object containing the URL parameters that the router
     * will link to a controller/action handling a fatal request.
     *
     * @see MvcTools/interfaces/ezcMvcDispatcherConfiguration::createFatalRedirectRequest()
     *
     * @param ezcMvcRequest $request
     * @param ezcMvcResult $result
     * @param Exception $response
     */
    function createFatalRedirectRequest( ezcMvcRequest $request, ezcMvcResult $result, Exception $response )
    {
        var_Dump( $request );
        $req = clone $request;
        $req->uri = '/FATAL';

        return $req;
    }



    /**
     * (non-PHPdoc)
     * @see MvcTools/interfaces/ezcMvcDispatcherConfiguration::runPreRoutingFilters()
     */
    function runPreRoutingFilters( ezcMvcRequest $request )
    {
    }



    /**
     * (non-PHPdoc)
     * @see MvcTools/interfaces/ezcMvcDispatcherConfiguration::runRequestFilters()
     */
    function runRequestFilters( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request )
    {
    }



    /**
     * (non-PHPdoc)
     * @see MvcTools/interfaces/ezcMvcDispatcherConfiguration::runResultFilters()
     */
    function runResultFilters( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request, ezcMvcResult $result )
    {
        $result->variables['installRoot'] = preg_replace( '@/index\.php$@', '', $_SERVER['SCRIPT_NAME'] );
    }



    /**
     * (non-PHPdoc)
     * @see MvcTools/interfaces/ezcMvcDispatcherConfiguration::runResponseFilters()
     */
    function runResponseFilters( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request, ezcMvcResult $result, ezcMvcResponse $response )
    {
    }
}

?>