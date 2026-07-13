<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application;

/**
 * Registro dei moduli della CM Performance Suite.
 *
 * Responsabile della registrazione di tutti i moduli.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.1
 */
final class Module_Registry
{
	/**
	 * Registra tutti i moduli.
	 *
	 * @return void
	 */
	public static function register(): void
	{
		Module_Manager::register(
			array(
				'id'          => 'module-manager',
				'name'        => 'Module Manager',
				'description' => 'Gestione dei moduli della CM Performance Suite.',
				'version'     => CMPS_VERSION,
				'status'      => true,
				'badge'       => 'alpha',
			)
		);
	}
}