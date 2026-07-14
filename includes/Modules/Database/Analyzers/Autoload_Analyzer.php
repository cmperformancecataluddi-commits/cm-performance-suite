<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Analyzers;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;

/**
 * Analyzer delle opzioni Autoload.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Autoload_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza il peso delle opzioni autoload.
	 *
	 * @param array<string,mixed> $data
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$wordpress = $data['wordpress'] ?? array();

		$autoload_size = (int) (
			$wordpress['autoload_size'] ?? 0
		);

		$autoload_count = (int) (
			$wordpress['autoload_count'] ?? 0
		);

		$status = Status::SUCCESS;
		$score  = 100;

		$recommendation = '';

		$one_mb   = 1024 * 1024;
		$three_mb = 3 * 1024 * 1024;

		if ( $autoload_size > $three_mb ) {

			$status = Status::DANGER;

			$score = 40;

			$recommendation =
				'Le opzioni autoload superano 3 MB. Individua i plugin che salvano dati caricati automaticamente e riduci il peso dell’autoload.';

		} elseif ( $autoload_size > $one_mb ) {

			$status = Status::WARNING;

			$score = 75;

			$recommendation =
				'Le opzioni autoload superano 1 MB. Verifica se esistono opzioni non necessarie caricate automaticamente.';

		}

		return $this->result(

			label: 'Autoload',

			value: sprintf(
				'%s (%d opzioni)',
				size_format( $autoload_size ),
				$autoload_count
			),

			status: $status,

			score: $score,

			description:
				'Dimensione complessiva delle opzioni WordPress caricate automaticamente ad ogni richiesta.',

			recommendation: $recommendation

		);

	}
}