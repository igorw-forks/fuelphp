<?php
/**
 * Generate Package Loader object and register Application with the Environment
 *
 * @package  App
 */

/**
 * Return the current active Request
 *
 * @param   null|string  $var
 * @return  Fuel\Kernel\Request\Base
 *
 * @since  2.0.0
 */
function _req($var = null)
{
	global $env, $app;
	$app = $env->active_application() ?: $app;

	$req = $app ? $app->active_request() : null;
	if ( ! $req)
	{
		return null;
	}

	return $var ? $req->{$var} : $req;
}

/**
 * Forge an object
 *
 * @param   string|array  $classname  classname or array($obj_name, $classname)
 * @return  object
 *
 * @since  2.0.0
 */
function _forge($classname)
{
	global $env, $app;
	$app = $env->active_application() ?: $app;

	return call_user_func_array(array($app ?: $env, 'forge'), func_get_args());
}

/**
 * Get an instance of a class
 *
 * @param   string       $classname
 * @param   null|string  $name
 * @return  object
 */
function _obj($classname, $name = null)
{
	global $env, $app;
	$app = $env->active_application() ?: $app;

	$dic = $app ? $app->dic : $env->dic;
	return $dic->get_object($classname, $name);
}