<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application;

/**
 * Classe base per tutti i Service Provider.
 *
 * @package CMPerformanceSuite
 * @since 1.0.0-alpha.3
 */
abstract class ServiceProvider
{
	/**
	 * Container dell'applicazione.
	 *
	 * @var Container
	 */
	protected Container $container;

	/**
	 * Costruttore.
	 *
	 * @param Container $container Container dell'applicazione.
	 */
	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	/**
	 * Registra i servizi.
	 *
	 * @return void
	 */
	abstract public function register(): void;

	/**
	 * Avvia il provider.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		// Override nei provider che ne hanno bisogno.
	}
}