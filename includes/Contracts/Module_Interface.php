<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Contracts;

/**
 * Contratto per tutti i moduli della CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.1
 */
interface Module_Interface
{
	/**
	 * Registra il modulo.
	 *
	 * @return void
	 */
	public function register(): void;
}