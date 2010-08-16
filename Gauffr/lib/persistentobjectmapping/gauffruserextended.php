<?php
/**
 * File containing the GauffrUser Persistent Object mapping.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 * @ignore
 */

$gauffr = Gauffr::getInstance();
$def = new ezcPersistentObjectDefinition();
$def->table = $gauffr->gauffrTables['GauffrUserExtended'];
$def->class = "GauffrUserExtended";

$def->idProperty = new ezcPersistentObjectIdProperty;
$def->idProperty->columnName = 'gauffruser_id';
$def->idProperty->propertyName = 'ID';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition( 'ezcPersistentNativeGenerator' );

$def->properties['AltLogin'] = new ezcPersistentObjectProperty;
$def->properties['AltLogin']->columnName = 'alt_login';
$def->properties['AltLogin']->propertyName = 'AltLogin';
$def->properties['AltLogin']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

/* Relation with extended information */
$def->relations["GauffrUser"] = new ezcPersistentOneToOneRelation(
    $gauffr->gauffrTables['GauffrUserExtended'],
    $gauffr->gauffrUserTable['TableName']
);
$def->relations["GauffrUser"]->columnMap = array(
    new ezcPersistentSingleTableMap( "gauffruser_id", $gauffr->gauffrUserTable['ID'] )
);

return $def;

?>