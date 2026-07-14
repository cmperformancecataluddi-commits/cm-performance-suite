<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Admin;

use CMPerformanceSuite\Admin\Services\System_Status;
use CMPerformanceSuite\Application\Module_Manager;
use CMPerformanceSuite\Application\View;

/**
 * Dashboard amministrativa della CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.2
 */
final class Dashboard
{
	/**
	 * Renderizza la dashboard.
	 *
	 * @return void
	 */
	public function render(): void
	{
		$status = ( new System_Status() )->get();

		View::render(
			'admin/dashboard',
			array(
				'status'       => $status,
				'wordpress'    => $status['wordpress'] ?? array(),
				'php'          => $status['php'] ?? array(),
				'woocommerce'  => $status['woocommerce'] ?? array(),
				'server'       => $status['server'] ?? array(),
				'database'     => $status['database'] ?? array(),
				'modules'      => Module_Manager::all(),
				'version'      => CMPS_VERSION,
			)
		);
	}
}