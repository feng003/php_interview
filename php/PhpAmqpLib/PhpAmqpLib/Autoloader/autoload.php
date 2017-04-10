<?php

namespace Vendor\PhpAmqpLib\Autoloader;

require_once 'Psr44Autoloader.php';

/**
 * @var string $srcBaseDirectory
 * Full path to "src/Spout" which is what we want "Vendor\Spout" to map to.
 */
$srcBaseDirectory = dirname(dirname(__FILE__));

$loader = new Psr44Autoloader();
$loader->register();
$loader->addNamespace('Vendor\PhpAmqpLib', $srcBaseDirectory);
