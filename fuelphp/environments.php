<?php
/**
 * Part of the FuelPHP framework.
 *
 * @package    Fuel
 * @version    2.0.0
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 *
 * @return  array
 */

use Fuel\Kernel\Environment;
use Fuel\Kernel\Loader;

/**
 * Here you setup your different environments
 * (put all defaults into '__default')
 */
return array(
	/**
	 * Default settings, these are always run first
	 *
	 * @param   Fuel\Kernel\Environment $env
	 * @return  void|\Closure
	 */
	'__default' => function(Environment $env)
	{
		// Switch off error display to allow Fuel to handle them
		// ini_set('display_errors', 'Off');

		// Return array with environment config
		$env->locale = null;
		$env->language = 'en';
		$env->timezone = 'UTC';
		$env->encoding = 'UTF-8';

		return function (Environment $env)
		{
			// Uncomment the following line to enable the Core package
			$env->loader->loadPackage('fuel/core', Loader::TYPE_CORE);
		};
	},

	/**
	 * Development environment
	 *
	 * @param   Fuel\Kernel\Environment $env
	 * @return  void|\Closure
	 */
	'development' => function(Environment $env)
	{
		error_reporting(-1);
	},

	/**
	 * Production environment
	 *
	 * @param   Fuel\Kernel\Environment $env
	 * @return  void|\Closure
	 */
	'production' => function(Environment $env)
	{
		error_reporting(0);
	},
);