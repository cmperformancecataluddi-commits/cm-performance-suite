<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application;

/**
 * Gestisce gli asset della CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.2
 */
final class Asset_Manager
{
	/**
	 * Registra un foglio di stile.
	 *
	 * @param string $handle Handle dello stile.
	 * @param string $file   Percorso relativo nella cartella assets.
	 *
	 * @return void
	 */
	public static function enqueue_style(
		string $handle,
		string $file
	): void {

		wp_enqueue_style(
			$handle,
			CMPS_URL . 'assets/' . ltrim( $file, '/' ),
			array(),
			CMPS_VERSION
		);
	}

	/**
	 * Registra uno script.
	 *
	 * @param string $handle Handle dello script.
	 * @param string $file   Percorso relativo nella cartella assets.
	 * @param array<int,string> $dependencies Dipendenze.
	 * @param bool $footer Carica nel footer.
	 *
	 * @return void
	 */
	public static function enqueue_script(
		string $handle,
		string $file,
		array $dependencies = array(),
		bool $footer = true
	): void {

		wp_enqueue_script(
			$handle,
			CMPS_URL . 'assets/' . ltrim( $file, '/' ),
			$dependencies,
			CMPS_VERSION,
			$footer
		);
	}
}