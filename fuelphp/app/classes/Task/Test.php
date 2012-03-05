<?php
/**
 * Part of your Application
 *
 * @package  App
 */

namespace App\Task;
use Classes;

/**
 * Example Task
 *
 * Can be called using "php oil app test"
 *
 * @package  App
 */
class Test extends Classes\Task\Base
{
	/**
	 * Return a simple string for commandline output
	 *
	 * @return  string
	 */
	public function action_index()
	{
		return 'Success';
	}
}
