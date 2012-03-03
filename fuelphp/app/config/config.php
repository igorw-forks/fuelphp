<?php

use Fuel\Kernel\Log;

return array(
	/**
	 * Basic settings for working with files
	 */
	'file' => array(
		'chmod' => array(
			'files' => 0666,
			'folders' => 0777,
		),
	),

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
		'logging' => function ($event, $source = null, $method = '') use ($app)
		{
			$app->get_object('Log')->info($event, $method);
		},
	),
);