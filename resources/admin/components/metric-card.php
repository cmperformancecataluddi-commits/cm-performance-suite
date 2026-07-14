<?php

declare(strict_types=1);

/**
 * Card metrica.
 *
 * Variabili:
 *
 * @var string              $title
 * @var array<string,mixed> $items
 */

/**
 * Formatta un valore per la visualizzazione.
 *
 * @var \Closure(string,mixed):string $format_value
 */
$format_value = static function (
	string $label,
	mixed $value
): string {

	if ( is_bool( $value ) ) {
		return $value ? 'Sì' : 'No';
	}

	if (
		in_array(
			$label,
			array(
				'memory_usage',
				'peak_memory',
			),
			true
		)
	) {
		return size_format( (int) $value );
	}

	return (string) $value;
};

?>

<div class="cmps-card">

	<h3>
		<?php echo esc_html( $title ); ?>
	</h3>

	<table class="widefat striped">

		<tbody>

			<?php foreach ( $items as $label => $value ) : ?>

				<tr>

					<td>

						<strong>

							<?php
							echo esc_html(
								ucwords(
									str_replace(
										'_',
										' ',
										(string) $label
									)
								)
							);
							?>

						</strong>

					</td>

					<td>

						<?php
						echo esc_html(
							$format_value(
								(string) $label,
								$value
							)
						);
						?>

					</td>

				</tr>

			<?php endforeach; ?>

		</tbody>

	</table>

</div>