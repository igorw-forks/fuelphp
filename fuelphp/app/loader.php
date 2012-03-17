<?php
/**
 * Generate Package Loader object and register Application with the Environment
 *
 * @package  App
 */

// Forge and return your Application Package object
return $env->forge('Loader.Package')
	->set_routable(true)
	->set_path(__DIR__)
	->set_namespace('App');
