<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Engine;

use CMPerformanceSuite\Contracts\Analyzer_Interface;
use CMPerformanceSuite\Modules\Performance\DTO\Performance_Report;

/**
 * Core Engine della CM Performance Suite.
 *
 * Coordina l'esecuzione degli Analyzer e genera
 * il report finale del modulo.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Core_Engine
{
	/**
	 * Manager degli Analyzer.
	 *
	 * @var Analyzer_Manager
	 */
	private Analyzer_Manager $analyzer_manager;

	/**
	 * Manager delle raccomandazioni.
	 *
	 * @var Recommendation_Manager
	 */
	private Recommendation_Manager $recommendation_manager;

	/**
	 * Calcolatore dello score.
	 *
	 * @var Score_Calculator
	 */
	private Score_Calculator $score_calculator;

	/**
	 * Costruttore.
	 */
	public function __construct()
	{
		$this->analyzer_manager       = new Analyzer_Manager();
		$this->recommendation_manager = new Recommendation_Manager();
		$this->score_calculator       = new Score_Calculator();
	}

	/**
	 * Registra un Analyzer.
	 *
	 * @param Analyzer_Interface $analyzer Analyzer.
	 *
	 * @return self
	 */
	public function add_analyzer(
		Analyzer_Interface $analyzer
	): self {

		$this->analyzer_manager->add( $analyzer );

		return $this;

	}

	/**
	 * Esegue tutti gli Analyzer.
	 *
	 * @param array<string,mixed> $data Dati raccolti.
	 *
	 * @return Performance_Report
	 */
	public function run(
		array $data
	): Performance_Report {

		$start = microtime( true );

		$report = new Performance_Report();

		$results = $this->analyzer_manager->analyze( $data );

		foreach ( $results as $result ) {
			$report->add_result( $result );
		}

		foreach (
			$this->recommendation_manager->collect( $results )
			as $recommendation
		) {

			$report->add_recommendation(
				$recommendation
			);

		}

		$report->set_overall_score(
			$this->score_calculator->calculate( $report )
		);

		$report->set_execution_time(
			microtime( true ) - $start
		);

		return $report;

	}
}