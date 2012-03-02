<?php

use Fuel\Kernel\Log;

return array(
	'log' => array(
		'level' => 4,
		'date_format' => 'Y-m-d H:i:s',
		'threshold' => Log::L_ALL & ~Log::L_INFO,
		// 'path' => $app->loader->path().'resources/logs/',
	),

	'file' => array(
		'chmod' => array(
			'files' => 0666,
			'folders' => 0777,
		),
	),
);