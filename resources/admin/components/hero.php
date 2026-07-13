<?php

declare(strict_types=1);

/**
 * Hero Dashboard.
 *
 * Variabili disponibili:
 *
 * @var array<string,mixed> $wordpress
 * @var array<string,mixed> $php
 * @var array<string,mixed> $woocommerce
 * @var array<string,mixed> $server
 * @var string              $version
 * @var int                 $registered_modules
 * @var int                 $active_modules
 */

$health = 100;

if ( ! $woocommerce['active'] ) {
	$health -= 10;
}

if ( version_compare( PHP_VERSION, '8.2', '<' ) ) {
	$health -= 10;
}

?>

<section class="cmps-hero">

	<div class="cmps-hero__content">

		<div class="cmps-hero__text">

			<span class="cmps-hero__kicker">
				Enterprise Dashboard
			</span>

			<h2>
				CM Performance Suite
			</h2>

			<p>
				Monitora WordPress, WooCommerce, PHP, server e moduli da
				un'unica dashboard professionale.
			</p>

		</div>

		<div class="cmps-hero__status">

			<div class="cmps-health">

				<span class="cmps-health__value">

					<?php echo esc_html( (string) $health ); ?>

				</span>

				<span class="cmps-health__label">

					Health Score

				</span>

			</div>

		</div>

	</div>

	<div class="cmps-hero__stats">

		<div class="cmps-hero-stat">

			<span class="cmps-hero-stat__value">

				<?php echo esc_html( $wordpress['version'] ?? '-' ); ?>

			</span>

			<span class="cmps-hero-stat__label">

				WordPress

			</span>

		</div>

		<div class="cmps-hero-stat">

			<span class="cmps-hero-stat__value">

				<?php echo esc_html( $php['version'] ?? '-' ); ?>

			</span>

			<span class="cmps-hero-stat__label">

				PHP

			</span>

		</div>

		<div class="cmps-hero-stat">

			<span class="cmps-hero-stat__value">

				<?php echo esc_html( $woocommerce['version'] ?? '—' ); ?>

			</span>

			<span class="cmps-hero-stat__label">

				WooCommerce

			</span>

		</div>

		<div class="cmps-hero-stat">

			<span class="cmps-hero-stat__value">

				<?php echo esc_html( (string) $active_modules ); ?>

				/

				<?php echo esc_html( (string) $registered_modules ); ?>

			</span>

			<span class="cmps-hero-stat__label">

				Moduli Attivi

			</span>

		</div>

	</div>

</section>