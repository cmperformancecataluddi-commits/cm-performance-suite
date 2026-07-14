<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Engine;

use CMPerformanceSuite\Application\Enums\Status;

/**
 * Gestisce il calcolo dei punteggi degli Analyzer.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Score_Manager
{
	/**
	 * Impedisce l'istanza della classe.
	 */
	private function __construct()
	{
	}

	/**
	 * Calcola lo score della versione PHP.
	 *
	 * @param string $version Versione PHP.
	 *
	 * @return array{
	 *     status:Status,
	 *     score:int,
	 *     message:string,
	 *     recommendation:?string
	 * }
	 */
	public static function php(
		string $version
	): array {

		$limits = Threshold_Manager::get( 'php' );

		$status         = Status::SUCCESS;
		$score          = 100;
		$message        = 'PHP aggiornata e perfettamente supportata.';
		$recommendation = null;

		if ( version_compare( $version, (string) $limits['danger'], '<=' ) ) {

			$status         = Status::DANGER;
			$score          = 30;
			$message        = 'Versione PHP non più supportata.';
			$recommendation = 'Aggiorna PHP almeno alla versione '
				. $limits['warning'];

		} elseif ( version_compare( $version, (string) $limits['warning'], '<' ) ) {

			$status         = Status::WARNING;
			$score          = 70;
			$message        = 'PHP funzionante ma consigliato l’aggiornamento.';
			$recommendation = 'Aggiorna PHP alla versione '
				. $limits['success'];

		}

		return array(
			'status'         => $status,
			'score'          => $score,
			'message'        => $message,
			'recommendation' => $recommendation,
		);

	}

	/**
	 * Calcola lo score della configurazione del server.
	 *
	 * @param array<string,mixed> $server Dati del server.
	 *
	 * @return array{
	 *     status:Status,
	 *     score:int,
	 *     message:string,
	 *     recommendation:?string
	 * }
	 */
	public static function server(
		array $server
	): array {

		$https       = (bool) ( $server['https'] ?? false );
		$opcache     = (bool) ( $server['opcache'] ?? false );
		$object_cache = (bool) ( $server['object_cache'] ?? false );

		$status         = Status::SUCCESS;
		$score          = 100;
		$message        = 'Configurazione del server ottimale.';
		$recommendation = null;

		if ( ! $https ) {
			$score -= 30;
		}

		if ( ! $opcache ) {
			$score -= 20;
		}

		if ( ! $object_cache ) {
			$score -= 10;
		}

		if ( $score < 90 ) {

			$status = Status::WARNING;
			$message = 'La configurazione del server può essere migliorata.';
			$recommendation = 'Abilita HTTPS, OPcache e Object Cache se disponibili.';

		}

		if ( $score < 60 ) {

			$status = Status::DANGER;
			$message = 'Configurazione del server non ottimale.';
			$recommendation = 'Verifica le impostazioni del server e della cache.';

		}

		return array(
			'status'         => $status,
			'score'          => $score,
			'message'        => $message,
			'recommendation' => $recommendation,
		);

	}
}