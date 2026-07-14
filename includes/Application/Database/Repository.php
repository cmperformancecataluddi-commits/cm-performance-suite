<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Database;

use wpdb;

/**
 * Repository base della CM Performance Suite.
 *
 * Tutti i repository del plugin estenderanno questa classe
 * per accedere al database in modo uniforme.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.1
 */
abstract class Repository
{
	/**
	 * Istanza di wpdb.
	 *
	 * @var wpdb
	 */
	protected wpdb $wpdb;

	/**
	 * Costruttore.
	 */
	public function __construct()
	{
		$this->wpdb = Database::wpdb();
	}

	/**
	 * Restituisce il prefisso delle tabelle WordPress.
	 *
	 * @return string
	 */
	protected function prefix(): string
	{
		return $this->wpdb->prefix;
	}

	/**
	 * Restituisce il nome completo di una tabella del plugin.
	 *
	 * @param string $table Nome tabella senza prefisso.
	 * @return string
	 */
	protected function table(string $table): string
	{
		return $this->prefix() . $table;
	}
}