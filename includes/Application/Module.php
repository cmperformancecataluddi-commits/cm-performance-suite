<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application;

/**
 * Classe base di tutti i moduli della CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.0.0-alpha.3
 */
abstract class Module
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
	 * Restituisce il nome del modulo.
	 *
	 * @return string
	 */
	abstract public function name(): string;

	/**
	 * Registra il modulo.
	 *
	 * @return void
	 */
	abstract public function register(): void;

	/**
	 * Avvia il modulo.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		// Override nei moduli che ne hanno bisogno.
	}
}