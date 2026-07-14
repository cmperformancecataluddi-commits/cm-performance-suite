<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Engine;

use CMPerformanceSuite\Modules\Database\DTO\Database_Report;

/**
 * Calcola lo score complessivo del Database Engine.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Score_Calculator
{
	/**
	 * Calcola lo score complessivo.
	 *
	 * @param Database_Report $report Report del Database Engine.
	 *
	 * @return int
	 */
	public function calculate(
		Database_Report $report
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