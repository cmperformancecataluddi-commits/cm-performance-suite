<?php
/**
 * Plugin Name: CM Performance Suite
 * Plugin URI: https://www.cmperformancesrls.it
 * Description: Core modulare della CM Performance Suite.
 * Version: 1.0.0-alpha.4
 * Requires at least: 6.8
 * Requires PHP: 8.2
 * Author: Mirko Cataluddi
 * Author URI: https://www.cmperformancesrls.it
 * License: GPL v2 or later
 * Text Domain: cm-performance-suite
 * Domain Path: /languages
 *
 * @package CMPerformanceSuite
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/*
|--------------------------------------------------------------------------
| Costanti
|--------------------------------------------------------------------------
*/

define('CMPS_VERSION', '1.0.0-alpha.4');
define('CMPS_FILE', __FILE__);
define('CMPS_PATH', plugin_dir_path(__FILE__));
define('CMPS_URL', plugin_dir_url(__FILE__));

/*
|--------------------------------------------------------------------------
| Composer Autoloader
|--------------------------------------------------------------------------
*/

require CMPS_PATH . 'vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Bootstrap
|--------------------------------------------------------------------------
*/

use CMPerformanceSuite\Bootstrap\Kernel;

$kernel = new Kernel();

$kernel->boot();