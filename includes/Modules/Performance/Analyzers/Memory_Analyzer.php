<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance\Analyzers;

use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;
use CMPerformanceSuite\Application\Engine\Threshold_Manager;

/**
 * Analyzer della memoria PHP.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Memory_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza la configurazione della memoria.
	 *
	 * @param array<string,mixed> $data Dati raccolti.
	 *
	 * @return \CMPerformanceSuite\Modules\Performance\DTO\Analysis_Result
	 */
	public function analyze(
		array $data
	): \CMPerformanceSuite\Modules\Performance\DTO\Analysis_Result {

		$php = $data['php'] ?? array();

		$memory_limit = $this->to_mb(
			(string) ( $php['memory_limit'] ?? '128M' )
		);

		$peak_memory = (int) ( $php['peak_memory'] ?? 0 );

		$peak_memory_mb = (int) round(
			$peak_memory / 1024 / 1024
		);

		$limits = Threshold_Manager::get( 'memory_limit' );

		$status         = Status::SUCCESS;
		$score          = 100;
		$message        = 'Configurazione della memoria ottimale.';
		$recommendation = null;

		if ( $memory_limit < $limits['danger'] ) {

			$status         = Status::DANGER;
			$score          = 30;
			$message        = 'Memory Limit insufficiente.';
			$recommendation = 'Imposta memory_limit ad almeno 256M.';

		} elseif ( $memory_limit < $limits['warning'] ) {

			$status         = Status::WARNING;
			$score          = 70;
			$message        = 'Memory Limit migliorabile.';
			$recommendation = 'Valuta un memory_limit di 512M.';

		} elseif ( $memory_limit < $limits['success'] ) {

			$status         = Status::SUCCESS;
			$score          = 90;
			$message        = 'Memory Limit adeguato.';
			$recommendation = '512M garantisce prestazioni migliori.';

		}

		return $this->result(
			'Memory',
			sprintf(
				'%d MB (Peak %d MB)',
				$memory_limit,
				$peak_memory_mb
			),
			$status,
			$score,
			$message,
			$recommendation
		);

	}

	/**
	 * Converte una memoria PHP in MB.
	 *
	 * @param string $value Valore.
	 *
	 * @return int
	 */
	private function to_mb(
		string $value
	): int {

		$value = strtoupper(
			trim( $value )
		);

		if ( str_ends_with( $value, 'G' ) ) {
			return (int) $value * 1024;
		}

		if ( str_ends_with( $value, 'M' ) ) {
			return (int) $value;
		}

		if ( str_ends_with( $value, 'K' ) ) {
			return (int) round(
				(int) $value / 1024
			);
		}

		return (int) round(
			(int) $value / 1024 / 1024
		);

	}
}