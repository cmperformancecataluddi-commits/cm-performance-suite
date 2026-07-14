<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance\Collectors;

use CMPerformanceSuite\Contracts\Collector_Interface;

/**
 * Raccolta delle metriche WooCommerce.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class WooCommerce_Collector implements Collector_Interface
{
	/**
	 * Restituisce le metriche WooCommerce.
	 *
	 * @return array<string,mixed>
	 */
	public function collect(): array
	{
		if ( ! class_exists( 'WooCommerce' ) ) {
			return array(
				'active' => false,
			);
		}

		return array(
			'active'     => true,
			'products'   => wp_count_posts( 'product' )->publish ?? 0,
			'orders'     => wp_count_posts( 'shop_order' )->publish ?? 0,
			'customers'  => count_users()['total_users'],
			'categories' => wp_count_terms(
				array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => false,
				)
			),
			'attributes' => count( wc_get_attribute_taxonomies() ),
			'sessions'   => function_exists( 'WC' ) && WC()->session
				? 'Attive'
				: 'Non disponibili',
		);
	}
}