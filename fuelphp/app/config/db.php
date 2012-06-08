<?php

use Doctrine\DBAL;

$connections = array(
	'default' => array(
		'dbname'    => 'test',
		'user'      => 'root',
		'password'  => 'root',
		'host'      => 'localhost',
		'driver'    => 'pdo_mysql',
	),
);

// Register db() function that gives access to named DBAL connections
$app->registerCallback('db', function($name = 'default') use ($app, $connections) {
	if ( ! isset($app->dbs[$name]))
	{
		$app->dbs[$name] = DBAL\DriverManager::getConnection(
			isset($connections[$name]) ? $connections[$name] : array(),
			new DBAL\Configuration()
		);
	}

	return $app->dbs[$name];
});