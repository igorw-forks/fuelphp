<?php

namespace App\Presenter;
use Fuel\Kernel\Environment;
use Classes;

class Welcome extends Classes\Presenter\Base
{
	public function view()
	{
		$this->presenter  = true;
		$this->version    = Environment::VERSION;
	}
}
