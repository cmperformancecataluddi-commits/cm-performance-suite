<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance\Analyzers;

use CMPerformanceSuite\Contracts\Analyzer_Interface;
use CMPerformanceSuite\Application\DTO\Analysis_Result;
use CMPerformanceSuite\Application\Engine\Score_Manager;

/**
 * Analyzer della configurazione del server.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Server_Analyzer extends Abstract_Analyzer implements Analyzer_Interface
{
	/**
	 * Analizza la configurazione del server.
	 *
	 * @param array<string,mixed> $data Dati raccolti.
	 *
	 * @return Analysis_Result
	 */
	public function analyze(
		array $data
	): Analysis_Result {

		$server = $data['server'] ?? array();

		$result = Score_Manager::server( $server );

		return $this->result(
			'Server',
			(string) ( $server['web_server'] ?? 'N/D' ),
			$result['status'],
			$result['score'],
			$result['message'],
			$result['recommendation']
		);

	}
}