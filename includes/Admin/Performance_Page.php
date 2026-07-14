<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Admin;

use CMPerformanceSuite\Application\View;
use CMPerformanceSuite\Modules\Performance\Performance_Service;

/**
 * Pagina amministrativa del Performance Monitor.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.3
 */
final class Performance_Page
{
	/**
	 * Servizio Performance.
	 *
	 * @var Performance_Service
	 */
	private Performance_Service $service;

	/**
	 * Costruttore.
	 */
	public function __construct()
	{
		$this->service = new Performance_Service();
	}

	/**
	 * Renderizza la pagina.
	 *
	 * @return void
	 */
	public function render(): void
	{
		View::render(
			'admin/performance',
			array(
				'status' => $this->service->collect(),
				'report' => $this->service->analyze(),
			)
		);
	}
}