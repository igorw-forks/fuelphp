<?php
/**
 * Generate Package Loader object and register Application with the Environment
 *
 * @package  App
 */

/**
 * Fetch the Fuel Environment
 *
 * @param   null|string  $var
 * @return  Fuel\Kernel\Environment
 *
 * @since  2.0.0
 */
function _env($var = null)
{
	$env = Fuel\Kernel\Environment::instance();
	return is_null($var) ? $env : $env->{$var};
}

/**
 * Return the current active Application
 *
 * @param   null|string  $var
 * @return  Fuel\Kernel\Application\Base
 *
 * @since  2.0.0
 */
function _app($var = null)
{
	if ( ! ($app = _env()->active_application()))
	{
		return null;
	}

	return $var ? $app->{$var} : $app;
}


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
	$req = ($app = _app()) ? $app->active_request() : null;
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
	return call_user_func_array(array(_app() ?: _env(), 'forge'), func_get_args());
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
	$dic = _app('dic') ?: _env('dic');
	return $dic->get_object($classname, $name);
}