<?php
/**
 * Setup Environment to run PHPUnit in
 *
 * @package    Fuel
 * @version    2.0.0
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 */

/**
 * Setup environment
 */
require __DIR__ . '/fuel/kernel/classes/Environment.php';
$env = new Fuel\Kernel\Environment();
$env->init(array(
	'name'  => 'testing',
	'path'  => __DIR__.'/',
));