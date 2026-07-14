<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Analyzers;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;

/**
 * Analyzer dell'engine del database.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Engine_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza gli engine utilizzati dal database.
	 *
	 * @param array<string,mixed> $data
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$database = $data['database'] ?? array();

		$main_engine = (string) (
			$database['main_engine'] ?? 'Unknown'
		);

		$engines = (array) (
			$database['engine_counts'] ?? array()
		);

		$status = Status::SUCCESS;
		$score = 100;

		$description =
			'Tutte le tabelle utilizzano InnoDB.';

		$recommendation = '';

		if ( isset( $engines['MyISAM'] ) ) {

			$status = Status::DANGER;

			$score = 30;

			$description =
				'Sono presenti tabelle MyISAM.';

			$recommendation =
				'Converti le tabelle MyISAM in InnoDB per migliorare affidabilità e prestazioni.';

		} elseif ( count( $engines ) > 1 ) {

			$status = Status::WARNING;

			$score = 75;

			$description =
				'Il database utilizza più engine.';

			$recommendation =
				'Valuta di uniformare tutte le tabelle utilizzando InnoDB.';

		}

		return $this->result(

			label: 'Database Engine',

			value: $main_engine,

			status: $status,

			score: $score,

			description: $description,

			recommendation: $recommendation

		);

	}
}