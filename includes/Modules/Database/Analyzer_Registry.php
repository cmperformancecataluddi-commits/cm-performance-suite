<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database;

use CMPerformanceSuite\Contracts\Analyzer_Interface;
use CMPerformanceSuite\Modules\Database\Analyzers\Autoload_Analyzer;
use CMPerformanceSuite\Modules\Database\Analyzers\Database_Size_Analyzer;
use CMPerformanceSuite\Modules\Database\Analyzers\Engine_Analyzer;
use CMPerformanceSuite\Modules\Database\Analyzers\Tables_Analyzer;

/**
 * Registry degli Analyzer del modulo Database.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Analyzer_Registry
{
	/**
	 * Restituisce tutti gli Analyzer registrati.
	 *
	 * @return array<int,Analyzer_Interface>
	 */
	public static function all(): array
	{
		return array(

			new Database_Size_Analyzer(),

			new Tables_Analyzer(),

			new Engine_Analyzer(),

			new Autoload_Analyzer(),

		);
	}
}