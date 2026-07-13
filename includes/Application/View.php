<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application;

use RuntimeException;

/**
 * Gestisce il rendering delle viste della CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.2
 */
final class View
{
	/**
	 * Percorso base delle risorse.
	 */
	private const BASE_PATH = CMPS_PATH . 'resources/';

	/**
	 * Renderizza una vista.
	 *
	 * @param string              $view Percorso della vista.
	 * @param array<string,mixed> $data Dati da passare alla vista.
	 *
	 * @throws RuntimeException Se la vista non esiste.
	 *
	 * @return void
	 */
	public static function render(
		string $view,
		array $data = array()
	): void {

		$file = self::resolve_path( $view );

		if ( ! file_exists( $file ) ) {
			throw new RuntimeException(
				sprintf(
					'View "%s" non trovata.',
					$view
				)
			);
		}

		if ( ! empty( $data ) ) {
			extract( $data, EXTR_SKIP );
		}

		require $file;
	}

	/**
	 * Restituisce il percorso assoluto della vista.
	 *
	 * @param string $view Percorso relativo.
	 *
	 * @return string
	 */
	private static function resolve_path(
		string $view
	): string {

		return self::BASE_PATH
			. trim( $view, '/' )
			. '.php';
	}
}