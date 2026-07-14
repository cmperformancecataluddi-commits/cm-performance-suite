<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Database;

use wpdb;

/**
 * Accesso centralizzato al database WordPress.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.1
 */
final class Database
{
	/**
	 * Restituisce l'istanza globale di wpdb.
	 *
	 * @return wpdb
	 */
	public static function wpdb(): wpdb
	{
		global $wpdb;

		return $wpdb;
	}
}