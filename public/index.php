<?php
/**
 * Part of the FuelPHP framework.
 *
 * @package    Fuel
 * @version    2.0.0
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 */

/**
 * Configure paths
 * (these constants are helpers and are not required by Fuel itself)
 */
define('DOCROOT', __DIR__.'/');
define('FUELPATH', DOCROOT.'../fuelphp/');
define('APPPATH', FUELPATH.'app/');
define('FUEL_INIT_TIME', microtime(true));
define('FUEL_INIT_MEM', memory_get_usage());

/**
 * Setup environment
 */
require FUELPATH.'fuel/kernel/classes/Environment.php';
use Fuel\Kernel\Environment;
$env = Environment::instance()->init(array(
	'name'  => isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : 'development',
	'path'  => FUELPATH,
));

/**
 * Initialize Application in package 'app'
 */
$app = $env->loader->load_application('app', function() {});

/**
 * Run the app and output the response headers
 */
$response = $app->request($env->input->uri())->execute()->response();
$response->send_headers();
$response = (string) $response->body();

/**
 * Compile profiling data
 */
$exec_time = round($env->profiler()->time_elapsed(), 5);
$mem_usage = round($env->profiler()->mem_usage() / 1000000, 4);
$mem_peak_usage = round($env->profiler()->mem_usage(true) / 1000000, 4);
$events = '';
foreach ($env->profiler()->events() as $timestamp => $event)
{
	$events .= '<li>'.str_pad($timestamp, 17, '0').' :: '.implode(' :: ', $event).'</li>';
}

/**
 * Output the response body and replace the profiling values
 */
echo str_replace(
	array('{exec_time}', '{mem_usage}', '{mem_peak_usage}', '{events}'),
	array($exec_time,    $mem_usage,    $mem_peak_usage,    '<ul>'.$events.'</ul>'),
	$response
);
