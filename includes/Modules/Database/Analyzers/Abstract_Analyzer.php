<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Analyzers;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Application\Enums\Status;

/**
 * Classe base per tutti gli Analyzer del modulo Database.
 *
 * Contiene i metodi condivisi utilizzati dagli Analyzer
 * del Database Engine.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
abstract class Abstract_Analyzer
{
	/**
	 * Crea un Analysis_Result.
	 *
	 * @param string      $label          Nome della metrica.
	 * @param string      $value          Valore.
	 * @param Status      $status         Stato.
	 * @param int         $score          Score.
	 * @param string      $description    Descrizione.
	 * @param string|null $recommendation Raccomandazione.
	 *
	 * @return Analysis_Result
	 */
	protected function result(
		string $label,
		string $value,
		Status $status,
		int $score,
		string $description,
		?string $recommendation = null
	): Analysis_Result {

		return new Analysis_Result(

			label: $label,

			value: $value,

			status: $status,

			score: $score,

			description: $description,

			recommendation: $recommendation ?? ''

		);

	}
}