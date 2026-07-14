<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance\Collectors;

/**
 * Raccolta delle metriche WordPress.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.1
 */
final class WordPress_Collector
{
	/**
	 * Restituisce le metriche WordPress.
	 *
	 * @return array<string,mixed>
	 */
	public function collect(): array
	{
		global $wpdb;

		return array(
			'version'        => get_bloginfo( 'version' ),
			'queries'        => get_num_queries(),
			'memory_usage'   => size_format( memory_get_usage( true ) ),
			'is_multisite'   => is_multisite(),
			'locale'         => get_locale(),
			'debug'          => defined( 'WP_DEBUG' ) && WP_DEBUG,
			'debug_log'      => defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG,
			'script_debug'   => defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG,
			'db_version'     => $wpdb->db_version(),
		);
	}
}