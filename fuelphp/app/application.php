<?php
/**
 * Part of your Application
 *
 * @package  App
 */

use Classes\Application;
use Classes\Route\Fuel as Route;

/**
 * Application class
 *
 * @package  App
 */
class App extends Application\Base
{
	public function router()
	{
		$this->add_route('/', 'Welcome');
	}

	public function config()
	{
		return array(
			'log_level' => 0,
		);
	}
}
