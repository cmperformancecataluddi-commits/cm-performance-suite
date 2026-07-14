<?php

declare(strict_types=1);

/**
 * @var array<string,mixed> $status
 */

?>

<div class="wrap cmps-dashboard">

	<h1>Performance Monitor</h1>

	<div class="cmps-card">

		<h2>
			Performance Engine
		</h2>

		<p>
			Il nuovo motore di analisi è attivo.
		</p>

		<table class="widefat striped">

			<tbody>

			<?php foreach ( $status as $key => $value ) : ?>

				<tr>

					<th>
						<?php echo esc_html( (string) $key ); ?>
					</th>

					<td>

						<pre><?php print_r( $value ); ?></pre>

					</td>

				</tr>

			<?php endforeach; ?>

			</tbody>

		</table>

	</div>

</div>