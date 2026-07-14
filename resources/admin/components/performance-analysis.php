<?php

declare(strict_types=1);

/**
 * Sezione del nuovo Performance Engine.
 *
 * Variabili disponibili:
 *
 * @var \CMPerformanceSuite\Modules\Performance\DTO\Performance_Report $report
 */

use CMPerformanceSuite\Application\View;

?>

<div class="cmps-section">

	<h2 class="cmps-section-title">

		Performance Analysis (Beta)

	</h2>

	<p class="description">

		Analisi intelligente del sistema basata sul nuovo Performance Engine.

	</p>

</div>

<div class="cmps-grid">

	<?php foreach ( $report->results() as $result ) : ?>

		<?php

		View::render(
			'admin/components/analysis-card',
			array(
				'result' => $result,
			)
		);

		?>

	<?php endforeach; ?>

</div>