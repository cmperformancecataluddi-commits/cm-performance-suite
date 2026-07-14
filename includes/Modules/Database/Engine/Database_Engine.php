<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Engine;

use CMPerformanceSuite\Contracts\Analyzer_Interface;
use CMPerformanceSuite\Modules\Database\DTO\Database_Report;

/**
 * Motore del modulo Database.
 *
 * Coordina l'esecuzione degli Analyzer e genera
 * un Database_Report completo.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Database_Engine
{
	/**
	 * Analyzer registrati.
	 *
	 * @var array<int,Analyzer_Interface>
	 */
	private array $analyzers = array();

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
		$this->score_calculator = new Score_Calculator();
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

		$this->analyzers[] = $analyzer;

		return $this;

	}

	/**
	 * Esegue tutti gli Analyzer.
	 *
	 * @param array<string,mixed> $data Dati raccolti.
	 *
	 * @return Database_Report
	 */
	public function run(
		array $data
	): Database_Report {

		$start = microtime( true );

		$report = new Database_Report();

		foreach ( $this->analyzers as $analyzer ) {

			$result = $analyzer->analyze( $data );

			$report->add_result( $result );

			if ( $result->has_recommendation() ) {

				$report->add_recommendation(
					(string) $result->recommendation()
				);

			}

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