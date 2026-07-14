<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance;

use CMPerformanceSuite\Application\Engine\Core_Engine;
use CMPerformanceSuite\Contracts\Collector_Interface;
use CMPerformanceSuite\Modules\Performance\DTO\Performance_Report;

/**
 * Servizio del modulo Performance Monitor.
 *
 * Coordina la raccolta delle metriche e l'esecuzione
 * del Core Engine.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.3
 */
final class Performance_Service
{
	/**
	 * Collector registrati.
	 *
	 * @var array<string,Collector_Interface>
	 */
	private array $collectors;

	/**
	 * Costruttore.
	 */
	public function __construct()
	{
		$this->collectors = Collector_Registry::all();
	}

	/**
	 * Restituisce tutte le metriche disponibili.
	 *
	 * Metodo legacy.
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
	 * Esegue il Core Engine.
	 *
	 * @return Performance_Report
	 */
	public function analyze(): Performance_Report
	{
		$data = $this->collect();

		$engine = new Core_Engine();

		foreach ( Analyzer_Registry::all() as $analyzer ) {
			$engine->add_analyzer( $analyzer );
		}

		return $engine->run( $data );
	}
}