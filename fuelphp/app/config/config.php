<?php

use Fuel\Kernel\Log;

return array(
	/**
	 * Named DBAL connection configurations
	 */
	'db' => $new('db', array(
		'default' => array(
			'dbname'    => 'test',
			'user'      => 'root',
			'password'  => 'root',
			'host'      => 'localhost',
			'driver'    => 'pdo_mysql',
		),
	)),

	/**
	 * Settings for cookies
	 */
	'cookie' => $new('cookie', array(
		'lifetime'   => 0,
		'path'       => '/',
		'domain'     => null,
		'secure'     => false,
		'httpOnly'  => false,
	)),

	/**
	 * Basic settings for working with files
	 */
	'file' => $new('file', array(
		'chmod' => array(
			'files' => 0666,
			'folders' => 0777,
		),
	)),

	/**
	 * Settings for logging
	 *
	 * Available flags: L_NONE, L_ERROR, L_WARNING, L_NOTICE, L_INFO, L_DEPRECATED, L_ALL
	 */
	'log' => array(
		'dateFormat' => 'Y-m-d H:i:s',
		// 'flags' => Log::L_ALL & ~Log::L_INFO,
		// 'path' => $app->loader->path().'resources/logs/',
	),

	/**
	 * Array of observers indexed by name and as value either a callback or array(callback, array-events)
	 */
	'observers' => array(
		/*
		'logging' => function ($event, $source = null, $method = '') use ($app)
		{
			$app->getObject('Log')->info($event, $method);
		},
		*/
	),

	/**
	 * Application Security settings
	 */
	'security' => array(
		'uriFilter'     => true,
		'outputFilter'  => true,
	),

	/**
	 * Error reporting settings
	 */
	'errors' => array(
		'viewError'   => 'error/dev',
		'viewFatal'   => 'error/500_dev',
		'continueOn'  => array(E_NOTICE, E_WARNING, E_DEPRECATED, E_STRICT, E_COMPILE_WARNING, E_USER_NOTICE, E_USER_WARNING, E_USER_DEPRECATED),
		'throttle'     => 10,
	),
);