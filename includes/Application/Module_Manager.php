<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application;

/**
 * Gestisce la registrazione dei moduli della CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.2
 */
final class Module_Manager
{
	/**
	 * Moduli registrati.
	 *
	 * @var array<string, Module_Definition>
	 */
	private static array $modules = array();

	/**
	 * Registra un modulo.
	 *
	 * @param array<string,mixed> $data Dati del modulo.
	 *
	 * @return void
	 */
	public static function register(array $data): void
	{
		$module = new Module_Definition( $data );

		self::$modules[ $module->get_id() ] = $module;
	}

	/**
	 * Restituisce tutti i moduli.
	 *
	 * @return array<string, Module_Definition>
	 */
	public static function all(): array
	{
		return self::$modules;
	}

	/**
	 * Restituisce un modulo.
	 *
	 * @param string $id ID del modulo.
	 *
	 * @return Module_Definition|null
	 */
	public static function get(string $id): ?Module_Definition
	{
		return self::$modules[ $id ] ?? null;
	}

	/**
	 * Verifica se un modulo è registrato.
	 *
	 * @param string $id ID del modulo.
	 *
	 * @return bool
	 */
	public static function has(string $id): bool
	{
		return isset( self::$modules[ $id ] );
	}

	/**
	 * Restituisce il numero di moduli registrati.
	 *
	 * @return int
	 */
	public static function count(): int
	{
		return count( self::$modules );
	}
}