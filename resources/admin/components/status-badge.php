<?php

declare(strict_types=1);

/**
 * Badge di stato.
 *
 * Variabili:
 *
 * @var string $label
 * @var string $type success|warning|danger|neutral
 */

$type = $type ?? 'neutral';

?>

<span class="cmps-status-badge cmps-status-badge--<?php echo esc_attr( $type ); ?>">

	<?php echo esc_html( $label ); ?>

</span>