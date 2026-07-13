<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application;

use CMPerformanceSuite\Admin\Admin;

/**
 * Core application della CM Performance Suite.
 *
 * Responsabile del ciclo di vita dell'applicazione.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.1
 */
final class Application
{
	/**
	 * Container dell'applicazione.
	 *
	 * @var Container
	 */
	private Container $container;

	/**
	 * Costruttore.
	 */
	public function __construct()
	{
		$this->container = new Container();
	}

	/**
	 * Restituisce il Container.
	 *
	 * @return Container
	 */
	public function container(): Container
	{
		return $this->container;
	}

	/**
	 * Avvia l'applicazione.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		Module_Registry::register();

		if ( is_admin() ) {
			new Admin();
		}
	}
}