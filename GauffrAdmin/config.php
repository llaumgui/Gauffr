<?php
/**
 * File containing the Gauffr class.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

ezcBase::addClassRepository( dirname( __FILE__ ) );

// Configure the template system by telling it where to find templates, and
// where to put the compiled templates.

$tc = ezcTemplateConfiguration::getInstance();
$tc->templatePath = dirname( __FILE__ ) . '/templates';
$tc->compilePath = dirname( __FILE__ ) . '../cache';

?>