<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Engine;

use CMPerformanceSuite\Contracts\Collector_Interface;

/**
 * Gestisce i Collector del Core Engine.
 *
 * Responsabile della registrazione e dell'esecuzione
 * di tutti i Collector della CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Collector_Manager
{
	/**
	 * Collector registrati.
	 *
	 * @var array<string,Collector_Interface>
	 */
	private array $collectors = array();

	/**
	 * Registra un Collector.
	 *
	 * @param string              $key       Identificativo del Collector.
	 * @param Collector_Interface $collector Collector.
	 *
	 * @return self
	 */
	public function add(
		string $key,
		Collector_Interface $collector
	): self {

		$this->collectors[ $key ] = $collector;

		return $this;

	}

	/**
	 * Verifica se un Collector è registrato.
	 *
	 * @param string $key Identificativo.
	 *
	 * @return bool
	 */
	public function has(
		string $key
	): bool {

		return isset( $this->collectors[ $key ] );

	}

	/**
	 * Restituisce tutti i Collector registrati.
	 *
	 * @return array<string,Collector_Interface>
	 */
	public function all(): array
	{
		return $this->collectors;
	}

	/**
	 * Esegue tutti i Collector registrati.
	 *
	 * @return array<string,mixed>
	 */
	public function collect(): array
	{
		$data = array();

		foreach ( $this->collectors as $key => $collector ) {
			$data[ $key ] = $collector->collect();
		}

		return $data;
	}

	/**
	 * Svuota tutti i Collector registrati.
	 *
	 * @return void
	 */
	public function clear(): void
	{
		$this->collectors = array();
	}
}