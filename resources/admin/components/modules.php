<?php

declare(strict_types=1);

/**
 * Elenco dei moduli registrati.
 *
 * Variabili disponibili:
 *
 * @var array<string,\CMPerformanceSuite\Application\Module_Definition> $modules
 */

$registered_modules = count( $modules );

?>

<section class="cmps-section cmps-modules-section">

	<div class="cmps-section__header">

		<div>

			<span class="cmps-section__kicker">
				Module Manager
			</span>

			<h2 class="cmps-section__title">
				Moduli registrati
			</h2>

			<p class="cmps-section__description">
				Componenti attualmente disponibili nella CM Performance Suite.
			</p>

		</div>

		<span class="cmps-badge cmps-badge--info">
			<?php echo esc_html( (string) $registered_modules ); ?>
		</span>

	</div>

	<?php if ( empty( $modules ) ) : ?>

		<div class="cmps-empty-state">

			<span class="dashicons dashicons-screenoptions"></span>

			<h3>
				Nessun modulo registrato
			</h3>

			<p>
				Il registro dei moduli non contiene ancora componenti disponibili.
			</p>

		</div>

	<?php else : ?>

		<div class="cmps-modules">

			<?php foreach ( $modules as $module ) : ?>

				<?php
				$is_enabled = $module->is_enabled();

				$module_status_class = $is_enabled
					? 'cmps-module--active'
					: 'cmps-module--inactive';

				$status_label = $is_enabled
					? 'Attivo'
					: 'Disattivato';

				$status_badge_class = $is_enabled
					? 'cmps-badge--success'
					: 'cmps-badge--neutral';

				$release_badge_class = match ( $module->get_badge() ) {
					'alpha'  => 'cmps-badge--warning',
					'beta'   => 'cmps-badge--info',
					'stable' => 'cmps-badge--success',
					default  => 'cmps-badge--neutral',
				};
				?>

				<article class="cmps-module <?php echo esc_attr( $module_status_class ); ?>">

					<div class="cmps-module__icon">

						<span class="dashicons dashicons-admin-plugins"></span>

					</div>

					<div class="cmps-module__content">

						<div class="cmps-module__heading">

							<h3 class="cmps-module__name">
								<?php echo esc_html( $module->get_name() ); ?>
							</h3>

							<div class="cmps-module__badges">

								<span class="cmps-badge <?php echo esc_attr( $release_badge_class ); ?>">
									<?php echo esc_html( strtoupper( $module->get_badge() ) ); ?>
								</span>

								<span class="cmps-badge <?php echo esc_attr( $status_badge_class ); ?>">
									<?php echo esc_html( $status_label ); ?>
								</span>

							</div>

						</div>

						<p class="cmps-module__description">
							<?php echo esc_html( $module->get_description() ); ?>
						</p>

						<div class="cmps-module__footer">

							<span class="cmps-module__version">
								Versione <?php echo esc_html( $module->get_version() ); ?>
							</span>

							<span class="cmps-module__state">
								<?php echo $is_enabled ? 'Operativo' : 'Non operativo'; ?>
							</span>

						</div>

					</div>

				</article>

			<?php endforeach; ?>

		</div>

	<?php endif; ?>

</section>