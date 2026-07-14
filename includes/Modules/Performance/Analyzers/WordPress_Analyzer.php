<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance\Analyzers;

use CMPerformanceSuite\Application\Enums\Status;
use CMPerformanceSuite\Contracts\Analyzer_Interface;
use CMPerformanceSuite\Modules\Performance\DTO\Analysis_Result;

/**
 * Analyzer della configurazione WordPress.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class WordPress_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza la configurazione WordPress.
	 *
	 * @param array<string,mixed> $data
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$wp = $data['wordpress'] ?? array();

		$version      = (string) ( $wp['version'] ?? get_bloginfo( 'version' ) );
		$debug        = (bool) ( $wp['debug'] ?? false );
		$debug_log    = (bool) ( $wp['debug_log'] ?? false );
		$script_debug = (bool) ( $wp['script_debug'] ?? false );

		$score = 100;

		if ( $debug ) {
			$score -= 20;
		}

		if ( $debug_log ) {
			$score -= 10;
		}

		if ( $script_debug ) {
			$score -= 10;
		}

		$status         = Status::SUCCESS;
		$message        = 'Configurazione WordPress ottimale.';
		$recommendation = null;

		if ( $score < 90 ) {
			$status = Status::WARNING;
			$message = 'La configurazione di WordPress può essere migliorata.';
			$recommendation = 'Disabilita WP_DEBUG, WP_DEBUG_LOG e SCRIPT_DEBUG in produzione.';
		}

		if ( $score < 60 ) {
			$status = Status::DANGER;
			$message = 'Configurazione WordPress non ottimale.';
			$recommendation = 'Correggi le impostazioni di debug dell’installazione.';
		}

		return $this->result(
			'WordPress',
			$version,
			$status,
			$score,
			$message,
			$recommendation
		);
	}
}