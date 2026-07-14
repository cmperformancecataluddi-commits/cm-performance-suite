<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Bootstrap;

use CMPerformanceSuite\Application\Database\Database_Manager;

/**
 * Attivazione della CM Performance Suite.
 *
 * Responsabile dell'installazione iniziale
 * e degli aggiornamenti del database.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.1
 */
final class Activator
{
	/**
	 * Attiva il plugin.
	 *
	 * @return void
	 */
	public static function activate(): void
	{
		$database = new Database_Manager();

		$database->install();
	}
}