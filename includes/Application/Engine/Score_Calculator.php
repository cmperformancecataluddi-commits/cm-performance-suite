<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Engine;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Modules\Performance\DTO\Performance_Report;

/**
 * Calcola lo score complessivo del Performance Report.
 *
 * Centralizza la logica di calcolo del punteggio finale
 * del Performance Engine.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Score_Calculator
{
	/**
	 * Calcola lo score medio del report.
	 *
	 * API legacy.
	 *
	 * @param Performance_Report $report Report.
	 *
	 * @return int
	 */
	public function calculate(
		Performance_Report $report
	): int {

		return $this->calculate_from_results(
			$report->results()
		);

	}

	/**
	 * Calcola lo score medio partendo dai risultati.
	 *
	 * @param array<int,Analysis_Result> $results
	 *
	 * @return int
	 */
	public function calculate_from_results(
		array $results
	): int {

		if ( empty( $results ) ) {
			return 0;
		}

		$total = 0;

		foreach ( $results as $result ) {
			$total += $result->score();
		}

		return (int) round(
			$total / count( $results )
		);

	}
}