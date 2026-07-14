<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Engine;

use CMPerformanceSuite\Application\DTO\Analysis_Result;

/**
 * Gestisce le raccomandazioni prodotte dagli Analyzer.
 *
 * Responsabile dell'estrazione e della normalizzazione
 * delle raccomandazioni contenute negli Analysis_Result.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Recommendation_Manager
{
	/**
	 * Estrae tutte le raccomandazioni.
	 *
	 * @param array<int,Analysis_Result> $results
	 *
	 * @return array<int,string>
	 */
	public function collect(
		array $results
	): array {

		$recommendations = array();

		foreach ( $results as $result ) {

			if ( ! $result->has_recommendation() ) {
				continue;
			}

			$recommendations[] = (string) $result->recommendation();

		}

		return array_values(
			array_unique( $recommendations )
		);

	}
}