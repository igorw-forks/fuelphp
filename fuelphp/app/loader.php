<?php
/**
 * Generate Package Loader object and register Application with the Environment
 *
 * @package  App
 */

_env()->register_application('app', 'App');

// Forge and return your Application Package object
return _forge('Loader:Package')
	->set_path(__DIR__);
