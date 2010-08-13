<?php
/**
 * File containing the GauffrSlave Persistent Object mapping.
 *
 * @version 0.3
 * @package Gauffr
 * @copyright Copyright (c) 2009 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 * @ignore
 */

$gauffr = Gauffr::getInstance();
$def = new ezcPersistentObjectDefinition();
$def->table = $gauffr->gauffrTables['GauffrSlave'];
$def->class = "GauffrSlave";

$def->idProperty = new ezcPersistentObjectIdProperty;
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'ID';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition( 'ezcPersistentNativeGenerator' );

$def->properties['Identifier'] = new ezcPersistentObjectProperty;
$def->properties['Identifier']->columnName = 'identifier';
$def->properties['Identifier']->propertyName = 'Identifier';
$def->properties['Identifier']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['Name'] = new ezcPersistentObjectProperty;
$def->properties['Name']->columnName = 'name';
$def->properties['Name']->propertyName = 'Name';
$def->properties['Name']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['Location'] = new ezcPersistentObjectProperty;
$def->properties['Location']->columnName = 'location';
$def->properties['Location']->propertyName = 'location';
$def->properties['Location']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

return $def;

?>