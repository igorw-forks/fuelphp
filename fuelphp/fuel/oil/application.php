<?php

use Classes\Application;

class Oil extends Application\Base
{
	public function setup()
	{
		$this->dic->set_classes(array(
			'Route'  => 'Classes\\Route\\Task',
			'View'   => 'Fuel\\Kernel\\View\\Base',
		));
	}

	public function router()
	{
		// Some shortcuts
		$this->add_route('(help)?', 'main/help');
		$this->add_route('v(ersion)?', 'main/version');
		$this->add_route('c', 'console');
		$this->add_route('cell', 'cells');
		$this->add_route('g', 'generate');
		$this->add_route('r', 'refine');
		$this->add_route('t', 'test');

		// Catch all route that checks if the intended Task exists
		$this->add_route('(.*)', '$1');

		// If all else fails, give the error and show help
		$cli = $this->get_object('Cli');
		$this->add_route('fail', $this->forge('Route',
			function ($controller) use ($cli) {
				$cli->write('Error: task for command "'.$controller.'" not found.');
				return true;
			},
			'main/help'
		));
	}
}
