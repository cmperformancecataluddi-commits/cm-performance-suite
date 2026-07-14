<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Engine;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Contracts\Analyzer_Interface;

/**
 * Gestisce gli Analyzer del Core Engine.
 *
 * Responsabile della registrazione e dell'esecuzione
 * di tutti gli Analyzer della CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Analyzer_Manager
{
	/**
	 * Analyzer registrati.
	 *
	 * @var array<int,Analyzer_Interface>
	 */
	private array $analyzers = array();

	/**
	 * Registra un Analyzer.
	 *
	 * @param Analyzer_Interface $analyzer Analyzer.
	 *
	 * @return self
	 */
	public function add(
		Analyzer_Interface $analyzer
	): self {

		$this->analyzers[] = $analyzer;

		return $this;

	}

	/**
	 * Verifica se sono presenti Analyzer.
	 *
	 * @return bool
	 */
	public function has(): bool
	{
		return ! empty( $this->analyzers );
	}

	/**
	 * Restituisce tutti gli Analyzer registrati.
	 *
	 * @return array<int,Analyzer_Interface>
	 */
	public function all(): array
	{
		return $this->analyzers;
	}

	/**
	 * Esegue tutti gli Analyzer.
	 *
	 * @param array<string,mixed> $data Dati raccolti.
	 *
	 * @return array<int,Analysis_Result>
	 */
	public function analyze(
		array $data
	): array {

		$results = array();

		foreach ( $this->analyzers as $analyzer ) {
			$results[] = $analyzer->analyze( $data );
		}

		return $results;

	}

	/**
	 * Svuota gli Analyzer registrati.
	 *
	 * @return void
	 */
	public function clear(): void
	{
		$this->analyzers = array();
	}
}