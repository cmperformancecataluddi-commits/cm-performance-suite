<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Database;

/**
 * Gestisce il database della CM Performance Suite.
 *
 * Responsabile della creazione e dell'aggiornamento
 * delle tabelle del plugin.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.1
 */
final class Database_Manager
{
	/**
	 * Versione dello schema database.
	 */
	private const SCHEMA_VERSION = '1.0.0';

	/**
	 * Opzione che memorizza la versione dello schema.
	 */
	private const OPTION_NAME = 'cmps_database_schema';

	/**
	 * Installa o aggiorna il database.
	 *
	 * @return void
	 */
	public function install(): void
	{
		$current = get_option(
			self::OPTION_NAME,
			''
		);

		if ( version_compare( $current, self::SCHEMA_VERSION, '>=' ) ) {
			return;
		}

		$this->create_tables();

		update_option(
			self::OPTION_NAME,
			self::SCHEMA_VERSION
		);
	}

	/**
	 * Crea le tabelle del plugin.
	 *
	 * @return void
	 */
	private function create_tables(): void
	{
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$this->create_snapshots_table();
	}

	/**
	 * Crea la tabella degli snapshot.
	 *
	 * @return void
	 */
	private function create_snapshots_table(): void
	{
		$table = Database::wpdb()->prefix . 'cmps_snapshots';

		$charset = Database::wpdb()->get_charset_collate();

		$sql = "
		CREATE TABLE {$table} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			created_at datetime NOT NULL,
			module varchar(100) NOT NULL,
			data longtext NOT NULL,
			PRIMARY KEY (id),
			KEY module (module),
			KEY created_at (created_at)
		) {$charset};
		";

		dbDelta( $sql );
	}
}