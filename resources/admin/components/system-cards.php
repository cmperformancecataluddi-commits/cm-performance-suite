<?php

declare(strict_types=1);

/**
 * Card riepilogative dello stato del sistema.
 *
 * Variabili disponibili:
 *
 * @var array<string,mixed>                                             $wordpress
 * @var array<string,mixed>                                             $php
 * @var array<string,mixed>                                             $woocommerce
 * @var array<string,\CMPerformanceSuite\Application\Module_Definition> $modules
 * @var string                                                          $version
 */

$registered_modules = count( $modules );
$active_modules     = 0;

foreach ( $modules as $module ) {
	if ( $module->is_enabled() ) {
		++$active_modules;
	}
}

$cards = array(

	array(
		'icon'   => '⚙️',
		'title'  => 'Suite',
		'value'  => $version,
		'status' => 'Enterprise',
		'class'  => 'info',
	),

	array(
		'icon'   => '🐘',
		'title'  => 'PHP',
		'value'  => $php['version'],
		'status' => version_compare( $php['version'], '8.2', '>=' ) ? 'Ottimale' : 'Da aggiornare',
		'class'  => version_compare( $php['version'], '8.2', '>=' ) ? 'success' : 'warning',
	),

	array(
		'icon'   => '🟦',
		'title'  => 'WordPress',
		'value'  => $wordpress['version'],
		'status' => 'Installato',
		'class'  => 'success',
	),

	array(
		'icon'   => '🛒',
		'title'  => 'WooCommerce',
		'value'  => $woocommerce['active']
			? ( $woocommerce['version'] ?? 'Attivo' )
			: '—',
		'status' => $woocommerce['active']
			? 'Attivo'
			: 'Non rilevato',
		'class'  => $woocommerce['active']
			? 'success'
			: 'danger',
	),

	array(
		'icon'   => '🧩',
		'title'  => 'Moduli',
		'value'  => (string) $registered_modules,
		'status' => 'Registrati',
		'class'  => 'info',
	),

	array(
		'icon'   => '✅',
		'title'  => 'Attivi',
		'value'  => sprintf(
			'%d / %d',
			$active_modules,
			$registered_modules
		),
		'status' => 'Operativi',
		'class'  => 'success',
	),

);

?>

<h2 class="cmps-section-title">
	Stato del sistema
</h2>

<div class="cmps-grid">

	<?php foreach ( $cards as $card ) : ?>

		<div class="cmps-card">

			<div class="cmps-card__icon">
				<?php echo esc_html( $card['icon'] ); ?>
			</div>

			<div class="cmps-card__title">
				<?php echo esc_html( $card['title'] ); ?>
			</div>

			<div class="cmps-card__value">
				<?php echo esc_html( $card['value'] ); ?>
			</div>

			<div class="cmps-card__status">

				<span class="cmps-badge cmps-badge--<?php echo esc_attr( $card['class'] ); ?>">

					<?php echo esc_html( $card['status'] ); ?>

				</span>

			</div>

		</div>

	<?php endforeach; ?>

</div>