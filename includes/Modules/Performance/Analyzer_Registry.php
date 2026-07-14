<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance;

use CMPerformanceSuite\Contracts\Analyzer_Interface;
use CMPerformanceSuite\Modules\Performance\Analyzers\Memory_Analyzer;
use CMPerformanceSuite\Modules\Performance\Analyzers\PHP_Analyzer;
use CMPerformanceSuite\Modules\Performance\Analyzers\Server_Analyzer;
use CMPerformanceSuite\Modules\Performance\Analyzers\WordPress_Analyzer;

/**
 * Registry degli Analyzer del modulo Performance.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
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
			new PHP_Analyzer(),
			new Memory_Analyzer(),
			new WordPress_Analyzer(),
			new Server_Analyzer(),
		);
	}
}