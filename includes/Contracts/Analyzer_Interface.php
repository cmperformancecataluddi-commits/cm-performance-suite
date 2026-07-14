<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Contracts;

use CMPerformanceSuite\Application\DTO\Analysis_Result;

/**
 * Contratto per tutti gli Analyzer della CM Performance Suite.
 *
 * Ogni Analyzer riceve i dati raccolti dai Collector
 * e restituisce un Analysis_Result.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
interface Analyzer_Interface
{
	/**
	 * Analizza i dati raccolti dai Collector.
	 *
	 * @param array<string,mixed> $data
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result;
}