<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Contracts;

/**
 * Contratto per tutti i collector della CM Performance Suite.
 *
 * Ogni collector deve restituire un array di metriche.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.1
 */
interface Collector_Interface
{
	/**
	 * Raccoglie le metriche.
	 *
	 * @return array<string,mixed>
	 */
	public function collect(): array;
}