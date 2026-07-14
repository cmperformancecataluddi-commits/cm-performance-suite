<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Analyzers;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;

/**
 * Analyzer delle tabelle del database.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Tables_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza il numero di tabelle del database.
	 *
	 * @param array<string,mixed> $data
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$database = $data['database'] ?? array();

		$total_tables = (int) ( $database['tables'] ?? 0 );

		$status = Status::SUCCESS;
		$score  = 100;

		$recommendation = '';

		if ( $total_tables > 500 ) {

			$status = Status::WARNING;

			$score = 80;

			$recommendation =
				'Il database contiene un numero elevato di tabelle. Verifica la presenza di plugin non più utilizzati o di tabelle obsolete.';

		}

		return $this->result(

			label: 'Database Tables',

			value: (string) $total_tables,

			status: $status,

			score: $score,

			description: 'Numero totale delle tabelle del database.',

			recommendation: $recommendation

		);

	}
}