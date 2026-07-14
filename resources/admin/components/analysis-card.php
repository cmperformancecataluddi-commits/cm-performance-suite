<?php

declare(strict_types=1);

/**
 * Card di analisi del Performance Engine.
 *
 * Variabili disponibili:
 *
 * @var \CMPerformanceSuite\Modules\Performance\DTO\Analysis_Result $result
 */

use CMPerformanceSuite\Application\Enums\Status;

?>

<div class="cmps-card cmps-analysis-card">

	<div class="cmps-analysis-header">

		<h3>
			<?php echo esc_html( $result->title() ); ?>
		</h3>

		<span class="cmps-badge <?php echo esc_attr( $result->status()->badge_class() ); ?>">
			<?php echo esc_html( ucfirst( $result->status()->value ) ); ?>
		</span>

	</div>

	<div class="cmps-analysis-score">

		<div class="cmps-analysis-score__value">

			<?php echo esc_html( (string) $result->score() ); ?>

			<span>/100</span>

		</div>

	</div>

	<p class="cmps-analysis-value">

		<strong>

			<?php echo esc_html( $result->value() ); ?>

		</strong>

	</p>

	<p class="cmps-analysis-message">

		<?php echo esc_html( $result->message() ); ?>

	</p>

	<?php if ( $result->has_recommendation() ) : ?>

		<div class="cmps-analysis-recommendation">

			<strong>Raccomandazione</strong>

			<p>

				<?php echo esc_html( $result->recommendation() ?? '' ); ?>

			</p>

		</div>

	<?php endif; ?>

</div>