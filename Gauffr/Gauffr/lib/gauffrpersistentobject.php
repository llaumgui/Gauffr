<?php
/**
 * File containing the abstract GauffrPersistentObject class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2011 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

/**
 * The GauffrPersistentObject classes.
 *
 * Persistence for all Gauffr* objects
 *
 * @package Gauffr
 * @version //autogentag//
 */
abstract class GauffrPersistentObject
{

    /**
     * Init a PersistentSession instance
     *
     * @return ezcPersistentSessionInstance
     */
    public static function getPersistentSessionInstance()
    {
        $gauffr = Gauffr::getInstance();
        return ezcPersistentSessionInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
    }



    /**
     * Init a PersistentSession instance
     *
     * @return ezcPersistentSessionInstance
     */
    public static function getPersistentSessionIdentity()
    {
        return GauffrPersistentSessionIdentity::getInstance();
    }



    /**
     * Set PersistantObject state
     *
     * @param array $properties
     */
    public function setState( array $properties )
    {
        foreach( $properties as $key => $value )
        {
            $this->$key = $value;
        }
    }



    /**
     * Get protected and read-only ID
     *
     * @return integer
     */
    public function getID()
    {
        return $this->ID;
    }



    /**
     * Get protected and read-only ID
     *
     * @param integer
     */
    public function setID( $id )
    {
        $this->ID = $id;
    }





/* ____________________________________________________________________ Fetch */

    /**
     * Fetch PersistantObject by attribut
     *
     * @param string $class The PersistentObject class
     * @param array $parameters
     */
    protected static function fetchPersistentObject( $class, $parameters = array() )
    {
    	isset($parameters['filter']) ? $filters = $parameters['filter']: $filters = false;
    	isset($parameters['orderby']) ? $orderBy = $parameters['orderby']: $orderBy= false;
    	isset($parameters['limit']) ? $limit = $parameters['limit']: $limit = false;
    	isset($parameters['groupby']) ? $groupBy = $parameters['groupby']: $groupBy = false;

        $session = self::getPersistentSessionInstance();
        $q = $session->createFindQuery( $class );

        self::fetchFilterPersistentObject( $q, $filters );
        self::fetchOrderByPersistentObject( $q, $orderBy );
        self::fetchGroupByPersistentObject( $q, $groupBy );
        self::fetchLimitPersistentObject( $q, $limit );

        return $session->find( $q, $class );
    }



    /**
     * Fetch count PersistantObject by attribut
     *
     * @param string $class The PersistentObject class
     * @param array $parameters
     */
    protected static function fetchCountPersistentObject( $tablename, $parameters = array() )
    {
    	isset($parameters['filter']) ? $filters = $parameters['filter']: $filters = false;

        $db = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
        $q = $db->createSelectQuery();
        $q->select( 'count(*) AS count' )->from( $tablename );

        self::fetchFilterPersistentObject( $q, $filters );

        $stmt = $q->prepare();
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows[0]['count'];
    }





/* ____________________________________________________ Function use by fetch */

    /**
     * Filter for fetch function
     *
     * @param ezcQuerySelect &$q
     * @param array $filter
     */
    private static function fetchFilterPersistentObject( &$q, $filters )
    {
        if ( $filters && is_array($filters) )
        {
            foreach( $filters as $filter )
            {
                if ( is_array($filter) && count($filter) == 3 )
                {
                    $attribut = $filter[0];
                    $type = 'bindValue';
                    $value = $filter[2];
                    $q->where( $q->expr->eq( $attribut, $q->$type( $value ) ) );
                }
                else
                    trigger_error('$filters parameter must be an array()', E_USER_WARNING);
            }
        }
    }



    /**
     * Order by for fetch function.
     * Order by can be:
     *  - a string: 'TIME'
     *  - an array: array('TIME, 'DESC')
     *  - an array of array: array( array( 'Severity' ), array( 'TIME, 'DESC') )
     *
     * @param ezcQuerySelect &$q
     * @param mixed $orderby
     */
    private static function fetchOrderByPersistentObject( &$q, $orderby )
    {
        if ( $orderby === false )
           return;

        if ( is_array($orderby) )
        {
            if ( is_array($orderby[0]) )
                self::fetchOrderByPersistentObject( $q, $orderby );
            else
            {
                if ( isset($orderby[1]) )
                   $q->orderBy( $orderby[0], $orderby[1] );
                else
                   $q->orderBy( $orderby[0] );
            }
        }
        else
        {
            $q->orderBy( $orderby);
        }
    }



    /**
     * Group by for fetch function.
     *
     * @param ezcQuerySelect &$q
     * @param string $groupby
     */
    private static function fetchGroupByPersistentObject( &$q, $groupby )
    {
        if ( $groupby === false )
           return;

        $q->groupBy( $groupby );
    }



    /**
     * Limit for fetch function.
     *
     * @param ezcQuerySelect &$q
     * @param mixed $groupby
     */
    private static function fetchLimitPersistentObject( &$q, $limit )
    {
        if ( $limit === false )
            return;

        if ( is_array($limit) )
            $q->limit( $limit[0], $limit[1] );
        else
            $q->limit( $limit );
    }



    /**
     * To be sure that a GauffrPersistentObject is unique
     *
     * @param array $array
     * @return array
     */
    public static function unique( array $array )
    {
        if ( count($array) != 1 )
            return false;

        return reset($array);
    }

}

?>