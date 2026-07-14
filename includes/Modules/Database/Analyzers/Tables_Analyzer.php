<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Analyzers;

use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;
use CMPerformanceSuite\Modules\Performance\DTO\Analysis_Result;

/**
 * Analyzer delle tabelle del database.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Tables_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza le tabelle del database.
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

		$engines = $database['engine_counts'] ?? array();

		$myisam = (int) ( $engines['MyISAM'] ?? 0 );

		$status = Status::SUCCESS;
		$score = 100;

		$recommendation = '';

		if ( $myisam > 0 ) {

			$status = Status::WARNING;

			$score = 80;

			$recommendation =
				sprintf(
					'%d tabelle utilizzano ancora MyISAM. Valuta la migrazione a InnoDB.',
					$myisam
				);

		}

		return new Analysis_Result(

			label: 'Database Tables',

			value: (string) $total_tables,

			status: $status,

			score: $score,

			description: 'Numero totale delle tabelle del database.',

			recommendation: $recommendation

		);

	}
}