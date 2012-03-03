<?php

use Fuel\Kernel\Log;

return array(
	/**
	 * Settings for cookies
	 */
	'cookie' => $app->forge(array('cookie', 'Config'), array(
		'lifetime'   => 0,
		'path'       => '/',
		'domain'     => null,
		'secure'     => false,
		'http_only'  => false,
	), 'cookie', $config),

	/**
	 * Basic settings for working with files
	 */
	'file' => $app->forge(array('file', 'Config'), array(
		'chmod' => array(
			'files' => 0666,
			'folders' => 0777,
		),
	), 'file', $config),

	/**
	 * Settings for logging
	 *
	 * Available flags: L_NONE, L_ERROR, L_WARNING, L_NOTICE, L_INFO, L_DEPRECATED, L_ALL
	 */
	'log' => array(
		'date_format' => 'Y-m-d H:i:s',
		'flags' => Log::L_ALL & ~Log::L_INFO,
		// 'path' => $app->loader->path().'resources/logs/',
	),

	/**
	 * Array of observers indexed by name and as value either a callback or array(callback, array-events)
	 */
	'observers' => array(
		/*
		'logging' => function ($event, $source = null, $method = '') use ($app)
		{
			$app->get_object('Log')->info($event, $method);
		},
		*/
	),
);