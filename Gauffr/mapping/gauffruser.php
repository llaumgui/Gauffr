<?php
/**
 * File containing the GauffrUser Persistent Object mapping.
 *
 * @version 0.3
 * @package Gauffr
 * @copyright Copyright (c) 2009 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 * @ignore
 */

$gauffr = Gauffr::getInstance();
$def = new ezcPersistentObjectDefinition();
$def->table = $gauffr->gauffrUserTable['TableName'];
$def->class = "GauffrUser";

$def->idProperty = new ezcPersistentObjectIdProperty;
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'ID';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition( 'ezcPersistentNativeGenerator' );

$def->properties['GroupID'] = new ezcPersistentObjectProperty;
$def->properties['GroupID']->columnName = $gauffr->gauffrUserTable['GroupID'];
$def->properties['GroupID']->propertyName = 'GroupID';
$def->properties['GroupID']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['Login'] = new ezcPersistentObjectProperty;
$def->properties['Login']->columnName = $gauffr->gauffrUserTable['Login'];
$def->properties['Login']->propertyName = 'Login';
$def->properties['Login']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['AltLogin'] = new ezcPersistentObjectProperty;
$def->properties['AltLogin']->columnName = $gauffr->gauffrUserTable['AltLogin'];
$def->properties['AltLogin']->propertyName = 'AltLogin';
$def->properties['AltLogin']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['Mail'] = new ezcPersistentObjectProperty;
$def->properties['Mail']->columnName = $gauffr->gauffrUserTable['Mail'];
$def->properties['Mail']->propertyName = 'Mail';
$def->properties['Mail']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

/*$def->relations["Credential"] = new ezcPersistentManyToManyRelation(
    $gauffr->gauffrUserTable['TableName'],
    $gauffr->gauffrTables['GauffrSlave'],
    $gauffr->gauffrTables['GauffrCredential']
);
$def->relations["Address"]->columnMap = array(
    new ezcPersistentDoubleTableMap( "id", "person_id", "address_id", "id" )
); */

return $def;

?>