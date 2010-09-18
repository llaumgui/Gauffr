<?php
/**
 * File containing the abstract GauffrPersistentObject class.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
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
     * Fetch PersistantObject by attribut
     *
     * @deprecated
     *
     * @param string $class The PersistentObject class
     * @param string $attribut The attribute to filter
     * @param string $value The value
     * @param string $orderby The attribute to sort
     *
     * @return GauffrPersistentObject
     */
    protected static function fetchPersistantObjectByAttribute( $class, $attribut, $value, $orderby = 'ID')
    {
        trigger_error("Deprecated function GauffrPersistentObject::fetchPersistantObjectByAttribute, use GauffrPersistentObject::fetch()", E_USER_WARNING);
        return self::fetchPersistantObject($class, array( array( $attribut, '=', $value ) ), $orderby );
    }



    /**
     * Fetch PersistantObject by attribut
     *
     * @param string $class The PersistentObject class
     * @param array $filter
     * @param mixed $orderby
     * @param mixed $limit
     */
    protected static function fetchPersistantObject( $class, $filters = false, $orderby = false, $limit = false )
    {
        $session = self::getPersistentSessionInstance();
        $q = $session->createFindQuery( $class );

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

        if ( $orderby )
        {
            if ( is_array($orderby) )
            {
            	trigger_error('$orderby is an array: not implemented yet !', E_USER_WARNING);
            }
            else
            {
                $q->orderBy( $orderby );
            }
        }

        if ( $limit )
        {
            if ( is_array($limit) )
                $q->limit( $limit[0], $limit[1] );
            else
            	$q->limit( $limit );
        }

        return $session->find( $q, $class );
    }



    /**
     * Fetch count PersistantObject by attribut
     *
     * @param string $class The PersistentObject class
     * @param array $filter
     */
    protected static function fetchCountPersistantObject( $tablename, $filters = false )
    {
        $db = ezcDbInstance::get(Gauffr::GAUFFR_DB_INSTANCE);
        $q = $db->createSelectQuery();
        $q->select( 'count(*) AS count' )->from( 'gauffr_log' );

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

        $stmt = $q->prepare(); // $stmt is a normal PDOStatement
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows[0]['count'];
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