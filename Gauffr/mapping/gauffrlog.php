<?php
/**
 * File containing the GauffrLog Persistent Object mapping.
 *
 * @version 0.3
 * @package Gauffr
 * @copyright Copyright (c) 2009 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 * @ignore
 */

$gauffr = Gauffr::getInstance();
$def = new ezcPersistentObjectDefinition();
$def->table = $gauffr->gauffrTables['GauffrLog'];
$def->class = "GauffrLog";

$def->idProperty = new ezcPersistentObjectIdProperty;
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'ID';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition( 'ezcPersistentNativeGenerator' );

$def->properties['Category'] = new ezcPersistentObjectProperty;
$def->properties['Category']->columnName = 'category';
$def->properties['Category']->propertyName = 'category';
$def->properties['Category']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['File'] = new ezcPersistentObjectProperty;
$def->properties['File']->columnName = 'file';
$def->properties['File']->propertyName = 'file';
$def->properties['File']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['Line'] = new ezcPersistentObjectProperty;
$def->properties['Line']->columnName = 'line';
$def->properties['Line']->propertyName = 'line';
$def->properties['Line']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['Message'] = new ezcPersistentObjectProperty;
$def->properties['Message']->columnName = 'message';
$def->properties['Message']->propertyName = 'message';
$def->properties['Message']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['Severity'] = new ezcPersistentObjectProperty;
$def->properties['Severity']->columnName = 'severity';
$def->properties['Severity']->propertyName = 'severity';
$def->properties['Severity']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['Source'] = new ezcPersistentObjectProperty;
$def->properties['Source']->columnName = 'source';
$def->properties['Source']->propertyName = 'source';
$def->properties['Source']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['Time'] = new ezcPersistentObjectProperty;
$def->properties['Time']->columnName = 'time';
$def->properties['Time']->propertyName = 'time';
$def->properties['Time']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

return $def;

?>