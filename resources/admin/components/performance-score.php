<?php

declare(strict_types=1);

/**
 * Card Performance Score.
 *
 * Variabili disponibili:
 *
 * @var \CMPerformanceSuite\Modules\Performance\DTO\Performance_Report $report
 */

$score = $report->overall_score();

$status = 'Excellent';

$badge = 'success';

if ( $score < 90 ) {
	$status = 'Good';
	$badge  = 'info';
}

if ( $score < 75 ) {
	$status = 'Warning';
	$badge  = 'warning';
}

if ( $score < 50 ) {
	$status = 'Critical';
	$badge  = 'danger';
}

?>

<div class="cmps-card cmps-performance-score">

	<div class="cmps-performance-score__header">

		<h2>
			Performance Score
		</h2>

		<span class="cmps-badge cmps-badge--<?php echo esc_attr( $badge ); ?>">
			<?php echo esc_html( strtoupper( $status ) ); ?>
		</span>

	</div>

	<div class="cmps-performance-score__value">

		<?php echo esc_html( (string) $score ); ?>

		<span>/100</span>

	</div>

	<div class="cmps-performance-score__meta">

		<p>

			<strong>Ultima analisi:</strong>

			<?php
			echo esc_html(
				$report
					->generated_at()
					->format( 'd/m/Y H:i:s' )
			);
			?>

		</p>

		<p>

			<strong>Tempo analisi:</strong>

			<?php
			echo esc_html(
				number_format(
					$report->execution_time(),
					4
				)
			);
			?>

			s

		</p>

	</div>

</div>