<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance\Analyzers;

use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Modules\Performance\DTO\Analysis_Result;

/**
 * Classe base di tutti gli Analyzer.
 *
 * Centralizza la creazione degli Analysis_Result.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
abstract class Abstract_Analyzer
{
	/**
	 * Crea un risultato standardizzato.
	 *
	 * @param string      $title Titolo.
	 * @param string      $value Valore.
	 * @param Status      $status Stato.
	 * @param int         $score Score.
	 * @param string      $message Messaggio.
	 * @param string|null $recommendation Raccomandazione.
	 *
	 * @return Analysis_Result
	 */
	final protected function result(
		string $title,
		string $value,
		Status $status,
		int $score,
		string $message,
		?string $recommendation = null
	): Analysis_Result {

		return new Analysis_Result(
			$title,
			$value,
			$status,
			max( 0, min( 100, $score ) ),
			$message,
			$recommendation
		);

	}
}