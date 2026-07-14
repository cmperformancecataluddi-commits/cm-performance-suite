<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance\Analyzers;

use CMPerformanceSuite\Contracts\Analyzer_Interface;
use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Application\Engine\Score_Manager;

/**
 * Analyzer della versione PHP.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class PHP_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza la configurazione PHP.
	 *
	 * @param array<string,mixed> $data Dati raccolti.
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$php = (string) ( $data['php']['version'] ?? PHP_VERSION );

		$result = Score_Manager::php( $php );

		return $this->result(
			'PHP',
			$php,
			$result['status'],
			$result['score'],
			$result['message'],
			$result['recommendation']
		);

	}
}