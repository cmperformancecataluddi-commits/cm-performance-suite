<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Analyzers;

use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;
use CMPerformanceSuite\Modules\Performance\DTO\Analysis_Result;

/**
 * Analyzer della dimensione del database.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Database_Size_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza la dimensione del database.
	 *
	 * @param array<string,mixed> $data
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$database = $data['database'] ?? array();

		$size = (int) ( $database['size'] ?? 0 );

		$status = Status::SUCCESS;
		$score  = 100;
		$recommendation = '';

		/*
		 * Soglie iniziali.
		 * Verranno spostate nel Threshold_Manager.
		 */

		if ( $size >= 1024 * 1024 * 1024 ) {

			$status = Status::DANGER;
			$score  = 40;

			$recommendation =
				'Il database supera 1 GB. Valuta una pulizia delle revisioni, dei transients e delle tabelle inutilizzate.';

		} elseif ( $size >= 512 * 1024 * 1024 ) {

			$status = Status::WARNING;
			$score  = 70;

			$recommendation =
				'Il database è piuttosto grande. Controlla la crescita delle tabelle e dell’autoload.';

		}

		return new Analysis_Result(

			label: 'Database Size',

			value: size_format( $size ),

			status: $status,

			score: $score,

			description: 'Dimensione complessiva del database.',

			recommendation: $recommendation

		);
	}
}