<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database;

use CMPerformanceSuite\Contracts\Collector_Interface;
use CMPerformanceSuite\Modules\Database\Collectors\Database_Collector;

/**
 * Registry dei Collector del modulo Database.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
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

			'database' => new Database_Collector(),

		);
	}
}