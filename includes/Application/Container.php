<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application;

use InvalidArgumentException;

/**
 * Service Container della CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.0.0-alpha.2
 */
final class Container
{
	/**
	 * Servizi registrati.
	 *
	 * @var array<string, mixed>
	 */
	private array $bindings = array();

	/**
	 * Singleton registrati.
	 *
	 * @var array<string, mixed>
	 */
	private array $instances = array();

	/**
	 * Registra un servizio.
	 *
	 * @param string $id      Identificatore.
	 * @param mixed  $service Servizio.
	 *
	 * @return void
	 */
	public function bind( string $id, mixed $service ): void
	{
		$this->bindings[ $id ] = $service;
	}

	/**
	 * Registra un singleton.
	 *
	 * @param string $id      Identificatore.
	 * @param mixed  $service Servizio.
	 *
	 * @return void
	 */
	public function singleton( string $id, mixed $service ): void
	{
		$this->instances[ $id ] = $service;
	}

	/**
	 * Verifica se un servizio esiste.
	 *
	 * @param string $id Identificatore.
	 *
	 * @return bool
	 */
	public function has( string $id ): bool
	{
		return isset( $this->bindings[ $id ] )
			|| isset( $this->instances[ $id ] );
	}

	/**
	 * Restituisce un servizio.
	 *
	 * @param string $id Identificatore.
	 *
	 * @return mixed
	 */
	public function make( string $id ): mixed
	{
		if ( isset( $this->instances[ $id ] ) ) {
			return $this->instances[ $id ];
		}

		if ( isset( $this->bindings[ $id ] ) ) {
			return $this->bindings[ $id ];
		}

		throw new InvalidArgumentException(
			sprintf(
				'Service "%s" is not registered.',
				$id
			)
		);
	}
}