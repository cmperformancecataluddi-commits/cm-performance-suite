<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Engine;

use CMPerformanceSuite\Modules\Performance\DTO\Performance_Report;

/**
 * Calcola lo score complessivo del Performance Report.
 *
 * Centralizza la logica di calcolo del punteggio finale
 * del Performance Engine.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.3
 */
final class Score_Calculator
{
	/**
	 * Calcola lo score medio del report.
	 *
	 * @param Performance_Report $report Report.
	 *
	 * @return int
	 */
	public function calculate(
		Performance_Report $report
	): int {

		$results = $report->results();

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