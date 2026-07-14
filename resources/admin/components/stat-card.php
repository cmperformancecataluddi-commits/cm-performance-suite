<?php

declare(strict_types=1);

/**
 * Card statistica.
 *
 * Variabili:
 *
 * @var string $title
 * @var string $value
 * @var string $icon
 */

?>

<div class="cmps-stat-card">

	<div class="cmps-stat-card__icon">

		<?php echo esc_html( $icon ); ?>

	</div>

	<div class="cmps-stat-card__content">

		<div class="cmps-stat-card__value">

			<?php echo esc_html( $value ); ?>

		</div>

		<div class="cmps-stat-card__title">

			<?php echo esc_html( $title ); ?>

		</div>

	</div>

</div>