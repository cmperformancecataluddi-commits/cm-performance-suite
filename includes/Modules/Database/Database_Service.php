<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database;

use CMPerformanceSuite\Contracts\Collector_Interface;
use CMPerformanceSuite\Modules\Database\DTO\Database_Report;
use CMPerformanceSuite\Modules\Database\Engine\Database_Engine;

/**
 * Servizio del modulo Database.
 *
 * Coordina la raccolta delle metriche e l'esecuzione
 * del Database Engine.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Database_Service
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
	 * Esegue il Database Engine.
	 *
	 * @return Database_Report
	 */
	public function analyze(): Database_Report
	{
		$data = $this->collect();

		$engine = new Database_Engine();

		foreach ( Analyzer_Registry::all() as $analyzer ) {

			$engine->add_analyzer( $analyzer );

		}

		return $engine->run( $data );
	}
}