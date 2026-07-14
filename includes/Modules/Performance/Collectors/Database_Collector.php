<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance\Collectors;

use CMPerformanceSuite\Contracts\Collector_Interface;

/**
 * Raccolta delle metriche del database.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Database_Collector implements Collector_Interface
{
	/**
	 * Restituisce le metriche del database.
	 *
	 * @return array<string,mixed>
	 */
	public function collect(): array
	{
		global $wpdb;

		$tables = (int) $wpdb->get_var(
			'SELECT COUNT(*) FROM information_schema.TABLES
			WHERE TABLE_SCHEMA = DATABASE()'
		);

		$database_size = (float) $wpdb->get_var(
			'SELECT SUM(data_length + index_length)
			FROM information_schema.TABLES
			WHERE TABLE_SCHEMA = DATABASE()'
		);

		$autoload = (int) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*) FROM {$wpdb->options} WHERE autoload = %s",
				'yes'
			)
		);

		$transients = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$wpdb->options}
			WHERE option_name LIKE '\_transient\_%'"
		);

		$revisions = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$wpdb->posts}
			WHERE post_type = 'revision'"
		);

		$spam = (int) $wpdb->get_var(
			"SELECT COUNT(*) FROM {$wpdb->comments}
			WHERE comment_approved = 'spam'"
		);

		return array(
			'tables'              => $tables,
			'database_size'       => size_format( (int) $database_size ),
			'database_size_bytes' => (int) $database_size,
			'autoload_options'    => $autoload,
			'transients'          => $transients,
			'revisions'           => $revisions,
			'spam_comments'       => $spam,
		);
	}
}