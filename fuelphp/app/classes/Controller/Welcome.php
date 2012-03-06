<?php

namespace App\Controller;
use App\Presenter;
use Classes;

class Welcome extends Classes\Controller\Base
{
	public function action_index()
	{
		$presenter = $this->app->forge('App\\Presenter\\Welcome');
		$presenter->set('input', $this->app->env->input, false);
		return $presenter;
	}

	public function action_view()
	{
		$view = $this->app->forge('View', 'welcome');
		$view->version = \Fuel\Kernel\Environment::VERSION;
		$view->set('input', $this->app->env->input, false);
		return $view;
	}

	public function action_baseline()
	{
		return '<h1>View- and Presenterless action</h1>

<p>
	<strong>Time elapsed:</strong> {exec_time}s<br />
	<strong>Memory usage:</strong> {mem_usage} MB<br />
	<strong>Peak memory usage:</strong> {mem_peak_usage} MB
</p>

<h3>Events</h3>

{events}';
	}
}
