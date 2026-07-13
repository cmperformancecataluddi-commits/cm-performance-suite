<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Bootstrap;

use CMPerformanceSuite\Application\Application;

/**
 * Bootstrap Kernel della CM Performance Suite.
 *
 * Responsabile dell'avvio dell'applicazione.
 *
 * @package CMPerformanceSuite
 * @since 1.0.0-alpha.3
 */
final class Kernel
{
	/**
	 * Istanza dell'applicazione.
	 *
	 * @var Application
	 */
	private Application $application;

	/**
	 * Costruttore.
	 */
	public function __construct()
	{
		$this->application = new Application();
	}

	/**
	 * Restituisce l'applicazione.
	 *
	 * @return Application
	 */
	public function application(): Application
	{
		return $this->application;
	}

	/**
	 * Avvia la Suite.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		$this->application->boot();
	}
}