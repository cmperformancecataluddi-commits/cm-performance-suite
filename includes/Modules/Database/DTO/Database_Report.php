<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\DTO;

use CMPerformanceSuite\Modules\Performance\DTO\Analysis_Result;

/**
 * Report completo del Database Engine.
 *
 * Contiene tutti i risultati prodotti dagli Analyzer
 * e le informazioni riepilogative.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Database_Report
{
	/**
	 * Risultati delle analisi.
	 *
	 * @var array<int,Analysis_Result>
	 */
	private array $results = array();

	/**
	 * Score complessivo.
	 *
	 * @var int
	 */
	private int $overall_score = 0;

	/**
	 * Raccomandazioni.
	 *
	 * @var array<int,string>
	 */
	private array $recommendations = array();

	/**
	 * Tempo di esecuzione.
	 *
	 * @var float
	 */
	private float $execution_time = 0.0;

	/**
	 * Data di generazione.
	 *
	 * @var \DateTimeImmutable
	 */
	private \DateTimeImmutable $generated_at;

	/**
	 * Costruttore.
	 */
	public function __construct()
	{
		$this->generated_at = new \DateTimeImmutable();
	}

	/**
	 * Aggiunge un risultato.
	 *
	 * @param Analysis_Result $result Risultato dell'analisi.
	 *
	 * @return void
	 */
	public function add_result(
		Analysis_Result $result
	): void {

		$this->results[] = $result;

	}

	/**
	 * Restituisce tutti i risultati.
	 *
	 * @return array<int,Analysis_Result>
	 */
	public function results(): array
	{
		return $this->results;
	}

	/**
	 * Imposta lo score complessivo.
	 *
	 * @param int $score Score complessivo.
	 *
	 * @return void
	 */
	public function set_overall_score(
		int $score
	): void {

		$this->overall_score = max(
			0,
			min( 100, $score )
		);

	}

	/**
	 * Restituisce lo score complessivo.
	 *
	 * @return int
	 */
	public function overall_score(): int
	{
		return $this->overall_score;
	}

	/**
	 * Aggiunge una raccomandazione.
	 *
	 * @param string $recommendation Raccomandazione.
	 *
	 * @return void
	 */
	public function add_recommendation(
		string $recommendation
	): void {

		$this->recommendations[] = $recommendation;

	}

	/**
	 * Restituisce le raccomandazioni.
	 *
	 * @return array<int,string>
	 */
	public function recommendations(): array
	{
		return $this->recommendations;
	}

	/**
	 * Imposta il tempo di esecuzione.
	 *
	 * @param float $seconds Tempo in secondi.
	 *
	 * @return void
	 */
	public function set_execution_time(
		float $seconds
	): void {

		$this->execution_time = $seconds;

	}

	/**
	 * Restituisce il tempo di esecuzione.
	 *
	 * @return float
	 */
	public function execution_time(): float
	{
		return $this->execution_time;
	}

	/**
	 * Restituisce la data di generazione.
	 *
	 * @return \DateTimeImmutable
	 */
	public function generated_at(): \DateTimeImmutable
	{
		return $this->generated_at;
	}
}