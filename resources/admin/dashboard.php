<?php

declare(strict_types=1);

use CMPerformanceSuite\Application\View;

/**
 * Vista principale della dashboard amministrativa.
 *
 * Variabili disponibili:
 *
 * @var array<string,mixed>                                             $wordpress
 * @var array<string,mixed>                                             $php
 * @var array<string,mixed>                                             $woocommerce
 * @var array<string,mixed>                                             $server
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

?>

<div class="wrap cmps-dashboard">

	<?php
	View::render(
		'admin/components/header',
		array(
			'version'            => $version,
			'registered_modules' => $registered_modules,
			'active_modules'     => $active_modules,
		)
	);
	?>

	<?php
	View::render(
		'admin/components/hero',
		array(
			'wordpress'          => $wordpress,
			'php'                => $php,
			'woocommerce'        => $woocommerce,
			'server'             => $server,
			'version'            => $version,
			'registered_modules' => $registered_modules,
			'active_modules'     => $active_modules,
		)
	);
	?>

	<?php
	View::render(
		'admin/components/system-cards',
		array(
			'wordpress'   => $wordpress,
			'php'         => $php,
			'woocommerce' => $woocommerce,
			'server'      => $server,
			'modules'     => $modules,
			'version'     => $version,
		)
	);
	?>

	<?php
	View::render(
		'admin/components/modules',
		array(
			'modules' => $modules,
		)
	);
	?>

	<?php
	if ( file_exists( CMPS_PATH . 'resources/admin/components/quick-actions.php' ) ) {
		View::render( 'admin/components/quick-actions' );
	}
	?>

	<?php
	if ( file_exists( CMPS_PATH . 'resources/admin/components/footer.php' ) ) {
		View::render( 'admin/components/footer' );
	}
	?>

</div>