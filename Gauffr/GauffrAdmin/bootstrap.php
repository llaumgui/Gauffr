<?php
/**
 * File containing the GauffrAdmin bootstrap.
 *
 * @version //autogentag//
 * @package GauffrAdmin
 * @copyright Copyright (c) 2010 Guillaume Kulakowski and contributors
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2.0
 */

// Start Gauffr
require 'Gauffr/gauffr.php';

// Add GauffrAdmin autoloads
ezcBase::addClassRepository( dirname( __FILE__ ) . '/..' );


// Init and load template system
ezcBaseInit::setCallback(
    'ezcInitTemplateConfiguration',
    'GauffrAdminLazyTemplateConfiguration'
);

define ('GAUFFR_ADMIN_TPL_PATH', dirname( __FILE__ ) . '/templates');
// Packager, change it ! (/tmp, /var/lib/GauffrAdmin, etc.)
define ('GAUFFR_ADMIN_CACHE_PATH', dirname( __FILE__ ) . '/../../cache');

$tpl = new ezcTemplate();
$tpl->send->charset = 'utf-8';

?>