<?php
/**
 * Part of your Application
 *
 * @package  App
 */

namespace App;
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
	 * Overwrites routes when called through "php oil app ..."
	 *
	 * @return  void
	 */
	public function _oil_router()
	{
		// Clean normal controller routes
		$this->routes = array();

		// Add Task routes
		$this->add_route('main_task', $this->forge('Route:Task', '(.*)', '$1'));
	}

	public function config()
	{
		return array(
			'log_level' => 0,
		);
	}
}
