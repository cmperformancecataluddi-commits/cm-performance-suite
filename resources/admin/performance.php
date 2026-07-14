<?php

declare(strict_types=1);

/**
 * Vista del Performance Monitor.
 *
 * Variabili disponibili:
 *
 * @var array<string,mixed> $status
 * @var \CMPerformanceSuite\Modules\Performance\DTO\Performance_Report $report
 */

use CMPerformanceSuite\Application\View;

?>

<div class="wrap cmps-dashboard">

	<?php
	View::render(
		'admin/components/header'
	);
	?>

	<div class="cmps-section">

		<h2 class="cmps-section-title">
			Performance Monitor
		</h2>

		<p class="description">
			Monitoraggio in tempo reale delle prestazioni della piattaforma.
		</p>

	</div>

	<?php

	View::render(
		'admin/components/performance-score',
		array(
			'report' => $report,
		)
	);

	?>

	<div class="cmps-grid">

		<?php

		View::render(
			'admin/components/metric-card',
			array(
				'title' => 'PHP',
				'items' => $status['php'] ?? array(),
			)
		);

		View::render(
			'admin/components/metric-card',
			array(
				'title' => 'WordPress',
				'items' => $status['wordpress'] ?? array(),
			)
		);

		View::render(
			'admin/components/metric-card',
			array(
				'title' => 'WooCommerce',
				'items' => $status['woocommerce'] ?? array(),
			)
		);

		View::render(
			'admin/components/metric-card',
			array(
				'title' => 'Server',
				'items' => $status['server'] ?? array(),
			)
		);

		View::render(
			'admin/components/metric-card',
			array(
				'title' => 'Database',
				'items' => $status['database'] ?? array(),
			)
		);

		?>

	</div>

	<?php

	View::render(
		'admin/components/performance-analysis',
		array(
			'report' => $report,
		)
	);

	?>

</div>