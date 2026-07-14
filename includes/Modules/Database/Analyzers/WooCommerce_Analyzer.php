<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Analyzers;

use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;

/**
 * Analyzer dello stato operativo di WooCommerce.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class WooCommerce_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza lo stato di WooCommerce.
	 *
	 * @param array<string,mixed> $data
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$woocommerce = $data['woocommerce'] ?? array();

		if ( empty( $woocommerce['active'] ) ) {

			return $this->result(

				label: 'WooCommerce',

				value: 'Non installato',

				status: Status::NEUTRAL,

				score: 100,

				description: 'WooCommerce non è installato o non è attivo.',

				recommendation: ''

			);

		}

		$pending_actions = (int) ( $woocommerce['pending_actions'] ?? 0 );
		$failed_actions  = (int) ( $woocommerce['failed_actions'] ?? 0 );
		$pending_orders  = (int) ( $woocommerce['pending_orders'] ?? 0 );
		$failed_orders   = (int) ( $woocommerce['failed_orders'] ?? 0 );

		$status         = Status::SUCCESS;
		$score          = 100;
		$description    = 'WooCommerce non presenta criticità.';
		$recommendation = '';

		if (
			$failed_actions > 0 ||
			$failed_orders > 0
		) {

			$status = Status::DANGER;
			$score  = 40;

			$description =
				'Sono presenti azioni o ordini non riusciti.';

			$recommendation =
				'Controlla Action Scheduler e verifica gli ordini con stato "Failed".';

		} elseif (
			$pending_actions > 100 ||
			$pending_orders > 20
		) {

			$status = Status::WARNING;
			$score  = 75;

			$description =
				'Sono presenti numerose operazioni in attesa.';

			$recommendation =
				'Verifica Action Scheduler e gli ordini in sospeso.';

		}

		return $this->result(

			label: 'WooCommerce',

			value: 'Attivo',

			status: $status,

			score: $score,

			description: $description,

			recommendation: $recommendation

		);

	}
}