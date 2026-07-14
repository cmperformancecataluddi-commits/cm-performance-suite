<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance;

use CMPerformanceSuite\Contracts\Collector_Interface;
use CMPerformanceSuite\Modules\Performance\Collectors\Database_Collector;
use CMPerformanceSuite\Modules\Performance\Collectors\PHP_Collector;
use CMPerformanceSuite\Modules\Performance\Collectors\Server_Collector;
use CMPerformanceSuite\Modules\Performance\Collectors\WooCommerce_Collector;
use CMPerformanceSuite\Modules\Performance\Collectors\WordPress_Collector;

/**
 * Registry dei Collector del modulo Performance.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.3
 */
final class Collector_Registry
{
	/**
	 * Restituisce tutti i Collector registrati.
	 *
	 * @return array<string,Collector_Interface>
	 */
	public static function all(): array
	{
		return array(
			'php'         => new PHP_Collector(),
			'wordpress'   => new WordPress_Collector(),
			'woocommerce' => new WooCommerce_Collector(),
			'server'      => new Server_Collector(),
			'database'    => new Database_Collector(),
		);
	}
}