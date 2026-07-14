<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Contracts;

use CMPerformanceSuite\Modules\Performance\DTO\Analysis_Result;

/**
 * Contratto per tutti gli Analyzer della Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.3
 */
interface Analyzer_Interface
{
	/**
	 * Analizza i dati raccolti dal Collector.
	 *
	 * @param array<string,mixed> $data
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result;
}