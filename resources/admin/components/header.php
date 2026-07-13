<?php

declare(strict_types=1);

?>

<header class="cmps-header">

	<div class="cmps-header__brand">

		<div class="cmps-header__logo">

			<span class="dashicons dashicons-superhero"></span>

		</div>

		<div class="cmps-header__content">

			<span class="cmps-header__kicker">
				Enterprise Platform
			</span>

			<h1 class="cmps-header__title">
				CM Performance Suite
			</h1>

			<p class="cmps-header__description">
				Piattaforma professionale per WordPress e WooCommerce
			</p>

		</div>

	</div>

	<div class="cmps-header__meta">

		<span class="cmps-badge cmps-badge--beta">
			BETA
		</span>

		<div class="cmps-header__version">

			<span class="cmps-header__version-label">
				Versione
			</span>

			<span class="cmps-version">
				<?php echo esc_html( CMPS_VERSION ); ?>
			</span>

		</div>

	</div>

</header>