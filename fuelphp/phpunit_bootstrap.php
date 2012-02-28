<?php

/**
 * Setup environment
 */
require __DIR__ . '/fuel/kernel/classes/Environment.php';
use Fuel\Kernel\Environment;
$env = Environment::instance()->init(array(
	'name'  => 'testing',
	'path'  => __DIR__.'/',
));