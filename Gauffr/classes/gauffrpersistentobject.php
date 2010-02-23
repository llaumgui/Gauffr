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
     * @param string $class The PersistentObject class
     * @param string $attribut The attribute to filter
     * @param string $value The value
     * @param string $orderby The attribute to sort
     * @return GauffrPersistentObject
     */
    protected static function fetchPersistantObjectByAttribute( $class, $attribut, $value, $orderby = 'ID')
    {
        $session = self::getPersistentSessionInstance();
        $q = $session->createFindQuery( $class );
        $q->where( $q->expr->eq( $attribut, $q->bindValue( $value ) ) )
            ->orderBy( $orderby );

        return $session->find( $q, $class );
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

} // EOC

?>