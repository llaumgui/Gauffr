<?php

// configuration start
EZC_BOOTSTRAP = ' /usr/share/pear/ezc/Base/ezc_bootstrap.php';
// configuration end

require EZC_BOOTSTRAP;

$tc = ezcTemplateConfiguration::getInstance();
$tc->templatePath = dirname( __FILE__ ) . '/templates';
$tc->compilePath = dirname( __FILE__ ) . '/cache';

?>