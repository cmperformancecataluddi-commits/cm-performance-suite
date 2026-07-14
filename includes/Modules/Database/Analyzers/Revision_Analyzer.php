<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Analyzers;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;

/**
 * Analyzer delle revisioni WordPress.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Revision_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza il numero di revisioni presenti nel database.
	 *
	 * @param array<string,mixed> $data Dati raccolti.
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$wordpress = $data['wordpress'] ?? array();

		$revisions = (int) (
			$wordpress['revisions'] ?? 0
		);

		$status         = Status::SUCCESS;
		$score          = 100;
		$description    = 'Il numero di revisioni è sotto controllo.';
		$recommendation = '';

		if ( $revisions > 500 ) {

			$status      = Status::DANGER;
			$score       = 40;
			$description = 'Il database contiene un numero molto elevato di revisioni.';

			$recommendation =
				'Elimina le revisioni non necessarie e imposta un limite tramite WP_POST_REVISIONS nel file wp-config.php.';

		} elseif ( $revisions > 100 ) {

			$status      = Status::WARNING;
			$score       = 75;
			$description = 'Il database contiene numerose revisioni.';

			$recommendation =
				'Valuta la pulizia delle revisioni meno recenti e limita il numero di revisioni conservate da WordPress.';

		}

		return $this->result(
			label: 'Revisioni WordPress',
			value: (string) $revisions,
			status: $status,
			score: $score,
			description: $description,
			recommendation: $recommendation
		);

	}
}