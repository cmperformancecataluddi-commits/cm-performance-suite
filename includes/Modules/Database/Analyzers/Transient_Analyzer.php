<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Analyzers;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;

/**
 * Analyzer dei Transient WordPress.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Transient_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza il numero di transient presenti.
	 *
	 * @param array<string,mixed> $data Dati raccolti.
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$wordpress = $data['wordpress'] ?? array();

		$transients = (int) (
			$wordpress['transients'] ?? 0
		);

		$status         = Status::SUCCESS;
		$score          = 100;
		$description    = 'Il numero di transient è nella norma.';
		$recommendation = '';

		if ( $transients > 1000 ) {

			$status      = Status::DANGER;
			$score       = 40;
			$description = 'Il database contiene un numero molto elevato di transient.';

			$recommendation =
				'Pulisci i transient scaduti e verifica eventuali plugin che ne generano un numero eccessivo.';

		} elseif ( $transients > 300 ) {

			$status      = Status::WARNING;
			$score       = 75;
			$description = 'Il database contiene molti transient.';

			$recommendation =
				'Verifica periodicamente i transient e rimuovi quelli non più necessari.';

		}

		return $this->result(

			label: 'WordPress Transients',

			value: (string) $transients,

			status: $status,

			score: $score,

			description: $description,

			recommendation: $recommendation

		);

	}
}