<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Admin\Services;

/**
 * Gestisce le informazioni sullo stato del sistema.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.2
 */
final class System_Status
{
	/**
	 * Restituisce lo stato del sistema.
	 *
	 * @return array<string, mixed>
	 */
	public function get(): array
	{
		return array(

			'wordpress' => array(
				'version' => get_bloginfo( 'version' ),
				'debug'   => defined( 'WP_DEBUG' ) && WP_DEBUG,
			),

			'php' => array(
				'version' => PHP_VERSION,
				'memory'  => ini_get( 'memory_limit' ),
			),

			'woocommerce' => array(
				'active' => class_exists( 'WooCommerce' ),
			),

			'server' => array(
				'software' => sanitize_text_field(
					(string) ( $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' )
				),
			),

		);
	}
}