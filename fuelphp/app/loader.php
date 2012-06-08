<?php
/**
 * Generate Package Loader object and register Application with the Environment
 *
 * @package  App
 */

// Forge and return your Application Package object
return $env->forge('Loader.Package')
	->setRoutable(true)
	->setPath(__DIR__)
	->setNamespace('App');
