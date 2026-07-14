<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Engine;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Modules\Performance\DTO\Performance_Report;

/**
 * Costruisce il Performance Report finale.
 *
 * Responsabile della costruzione del DTO
 * Performance_Report.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Report_Builder
{
	/**
	 * Costruisce il report finale.
	 *
	 * @param array<int,Analysis_Result> $results
	 * @param array<int,string>          $recommendations
	 * @param int                        $score
	 * @param float                      $execution_time
	 *
	 * @return Performance_Report
	 */
	public function build(
		array $results,
		array $recommendations,
		int $score,
		float $execution_time
	): Performance_Report {

		$report = new Performance_Report();

		foreach ( $results as $result ) {
			$report->add_result( $result );
		}

		foreach ( $recommendations as $recommendation ) {
			$report->add_recommendation(
				$recommendation
			);
		}

		$report->set_overall_score(
			$score
		);

		$report->set_execution_time(
			$execution_time
		);

		return $report;

	}
}