<?php
/**
 * File containing the GauffrCredential Persistent Object mapping.
 *
 * @version //autogentag//
 * @package Gauffr
 * @copyright Copyright (c) 2009-2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 * @ignore
 */

$gauffr = Gauffr::getInstance();
$def = new ezcPersistentObjectDefinition();
$def->table =  $gauffr->gauffrTables['GauffrCredential'];
$def->class = "GauffrCredential";

$def->idProperty = new ezcPersistentObjectIdProperty;
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'ID';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition( 'ezcPersistentNativeGenerator' );

$def->properties['Can'] = new ezcPersistentObjectProperty;
$def->properties['Can']->columnName = 'can';
$def->properties['Can']->propertyName = 'Can';
$def->properties['Can']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['GauffrUserID'] = new ezcPersistentObjectProperty;
$def->properties['GauffrUserID']->columnName = 'gauffruser_id';
$def->properties['GauffrUserID']->propertyName = 'GauffrUserID';
$def->properties['GauffrUserID']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

return $def;

?>