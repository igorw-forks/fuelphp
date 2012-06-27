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
	/**
	 * Configure the application's routes
	 */
	protected function setRoutes()
	{
		$this->addRoute('/', 'Welcome');
		parent::setRoutes();
	}

	/**
	 * Oil Magic Method: overwrites routes when called through "php oil app ..."
	 *
	 * @return  void
	 */
	public function setOilRoutes()
	{
		// Clean normal controller routes
		$this->routes = array();

		// Change default Route class for DiC forge
		$this->dic->setClass('Route', 'Fuel\\Kernel\\Route\\Task');

		// Add Task routes
		$this->addRoute('(.*)', '$1');
	}

	/**
	 * Some application defaults, these will be overwritten by any config files found
	 *
	 * @param   Config  $config
	 * @return  void
	 */
	protected function setConfig(Config $config)
	{
		$config->set(array(
			'log_level' => 0,
		));

		// Return the parent method which runs ->load('config.php') on it
		return parent::setConfig($config);
	}
}
