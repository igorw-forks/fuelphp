<?php

namespace Fuel\Oil\Task;
use Classes;

class Composer extends Classes\Task\Base
{
	/**
	 * @var  string
	 */
	protected $command = '';

	public function before()
	{
		chdir(_env()->path('fuel').'../');
		$this->command = 'php '._env()->path('fuel').'fuel/oil/resources/vendor/Composer/composer.phar ';
	}

	public function after($response)
	{
		passthru($this->command);

		return parent::after($response);
	}

	/**
	 * Run the Composer install command
	 */
	public function action_install()
	{
		$this->command .= 'install';
	}

	/**
	 * Run the Composer update command
	 */
	public function action_update()
	{
		$this->command .= 'update';
	}
}
