<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Analyzers;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;

/**
 * Analyzer dell'overhead del database.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Overhead_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza lo spazio recuperabile del database.
	 *
	 * @param array<string,mixed> $data Dati raccolti.
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$database = $data['database'] ?? array();

		$overhead = (int) (
			$database['overhead'] ?? 0
		);

		$status         = Status::SUCCESS;
		$score          = 100;
		$description    = 'Il database non presenta overhead significativo.';
		$recommendation = '';

		$ten_mb    = 10 * 1024 * 1024;
		$fifty_mb  = 50 * 1024 * 1024;

		if ( $overhead > $fifty_mb ) {

			$status      = Status::DANGER;
			$score       = 40;
			$description = 'Il database contiene molto spazio recuperabile.';

			$recommendation =
				'Ottimizza le tabelle del database per recuperare spazio e migliorare le prestazioni.';

		} elseif ( $overhead > $ten_mb ) {

			$status      = Status::WARNING;
			$score       = 75;
			$description = 'Il database contiene spazio recuperabile.';

			$recommendation =
				'Valuta un\'ottimizzazione periodica delle tabelle del database.';

		}

		return $this->result(

			label: 'Database Overhead',

			value: size_format( $overhead ),

			status: $status,

			score: $score,

			description: $description,

			recommendation: $recommendation

		);

	}
}