<?php
/**
 * Generate Package Loader object and register Application with the Environment
 *
 * @package  App
 */

use Doctrine\DBAL;

$env->dic->setClasses(array(
	'DbConnection' => function($objs, $config)
	{
		! is_array($config) and $config = $objs['app']->config('db.'.$config);
		if ( ! is_array($config))
		{
			throw new \RuntimeException('Database configuration "'.$config.'" could not be found or is invalid.');
		}

		return DBAL\DriverManager::getConnection($config, new DBAL\Configuration());
	},
));

// Forge and return your Application Package object
return $env->forge('Loader.Package')
	->setRoutable(true)
	->setPath(__DIR__)
	->setNamespace('App');
