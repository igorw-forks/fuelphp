<?php
/**
 * Generate Package Loader object for Composer packages
 *
 * @package    Fuel
 * @version    2.0.0
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 */

// Returns the specialized Loader for Composer packages
return $env->forge('Loader:Composer');