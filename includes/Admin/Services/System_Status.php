<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Admin\Services;

use CMPerformanceSuite\Modules\Performance\Performance_Service;

/**
 * Gestisce le informazioni sullo stato del sistema.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.2
 */
final class System_Status
{
	/**
	 * Servizio Performance.
	 *
	 * @var Performance_Service
	 */
	private Performance_Service $performance;

	/**
	 * Costruttore.
	 */
	public function __construct()
	{
		$this->performance = new Performance_Service();
	}

	/**
	 * Restituisce lo stato del sistema.
	 *
	 * @return array<string,mixed>
	 */
	public function get(): array
	{
		return $this->performance->collect();
	}
}