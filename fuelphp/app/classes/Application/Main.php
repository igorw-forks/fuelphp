<?php
/**
 * Part of your Application
 *
 * @package  App
 */

namespace App\Application;
use Fuel\Kernel\Data\Config;
use Classes\Application;
use Classes\Route\Fuel as Route;

/**
 * Application class
 *
 * @package  App
 */
class Main extends Application\Base
{
	public function set_routes()
	{
		$this->add_route('/', 'Welcome');

		parent::set_routes();
	}

	/**
	 * Fuel Magic Method for Oil
	 *
	 * Overwrites routes when called through "php oil app ..."
	 *
	 * @return  void
	 */
	public function set_oil_routes()
	{
		// Clean normal controller routes
		$this->routes = array();

		// Change default Route class for DiC forge
		$this->dic->set_class('Route', 'Fuel\\Kernel\\Route\\Task');

		// Add Task routes
		$this->add_route('(.*)', '$1');
	}

	public function set_config(Config $config)
	{
		$config->set(array(
			'log_level' => 0,
		));

		// Return the parent method which runs ->load('config.php') on it
		return parent::set_config($config);
	}
}
