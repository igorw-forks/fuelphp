<?php
/**
 * Part of your Application
 *
 * @package  App
 */

namespace App\Application;
use Classes\Application;
use Classes\Route\Fuel as Route;

/**
 * Application class
 *
 * @package  App
 */
class Main extends Application\Base
{
	public function router()
	{
		$this->add_route('/', 'Welcome');
	}

	/**
	 * Fuel Magic Method for Oil
	 *
	 * Overwrites routes when called through "php oil app ..."
	 *
	 * @return  void
	 */
	public function _oil_router()
	{
		// Clean normal controller routes
		$this->routes = array();

		// Change default Route class for DiC forge
		$this->dic->set_class('Route', 'Fuel\\Kernel\\Route\\Task');

		// Add Task routes
		$this->add_route('(.*)', '$1');
	}

	public function config()
	{
		return array(
			'log_level' => 0,
		);
	}
}
