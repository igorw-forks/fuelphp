<?php

use Fuel\Kernel\Loader;

/**
 * Here you setup your different environments
 * (put all defaults into '__default')
 *
 * @return  \Closure[]
 */
return array(
	/**
	 * Default settings, these are always run first
	 */
	'__default' => function()
	{
		// Switch off error display to allow Fuel to handle them
		// Uses suppression as some setups don't allow ini_set()
		// @ini_set('display_errors', 'Off');

		// Optional: include Packagist loader
		// _env('loader')->load_package(require __DIR__.'/composerloader.php', Loader::TYPE_CORE);

		// Return array with environment config
		return array(
			'locale'    => null,
			'language'  => 'en',
			'timezone'  => 'UTC',
			'encoding'  => 'UTF-8',
			'packages'  => array('fuel/core'),
		);
	},

	/**
	 * Development environment
	 */
	'development' => function()
	{
		error_reporting(-1);
	},

	/**
	 * Production environment
	 */
	'production' => function()
	{
		error_reporting(0);
	},
);