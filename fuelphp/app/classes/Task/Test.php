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
 * Can be called using "php oil r <appname>/<taskname>" which will
 * be "php oil r app/test" for this one's index action or in full
 * "php oil r app/test/index"
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
