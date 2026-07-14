<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Engine;

/**
 * Gestisce tutte le soglie del Performance Engine.
 *
 * Centralizza i valori utilizzati dagli Analyzer per
 * determinare score, stato e raccomandazioni.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Threshold_Manager
{
	/**
	 * Restituisce tutte le soglie.
	 *
	 * @return array<string,mixed>
	 */
	public static function all(): array
	{
		return array(

			/*
			|--------------------------------------------------------------------------
			| PHP
			|--------------------------------------------------------------------------
			*/

			'php' => array(

				'danger' => '8.1',

				'warning' => '8.2',

				'success' => '8.3',

			),

			/*
			|--------------------------------------------------------------------------
			| WordPress
			|--------------------------------------------------------------------------
			*/

			'wordpress' => array(

				'debug'        => false,
				'debug_log'    => false,
				'script_debug' => false,

			),

			/*
			|--------------------------------------------------------------------------
			| Server
			|--------------------------------------------------------------------------
			*/

			'server' => array(

				'https'        => true,
				'opcache'      => true,
				'object_cache' => true,

			),

			/*
			|--------------------------------------------------------------------------
			| Database
			|--------------------------------------------------------------------------
			*/

			'database' => array(

				'autoload_warning'   => 500,
				'autoload_danger'    => 1000,

				'transients_warning' => 300,
				'transients_danger'  => 1000,

				'revisions_warning'  => 500,
				'revisions_danger'   => 2000,

				'spam_warning'       => 10,
				'spam_danger'        => 100,

			),

			/*
			|--------------------------------------------------------------------------
			| Memory Limit (MB)
			|--------------------------------------------------------------------------
			*/

			'memory_limit' => array(

				'danger' => 128,

				'warning' => 256,

				'success' => 512,

			),

			/*
			|--------------------------------------------------------------------------
			| Memory Usage (%)
			|--------------------------------------------------------------------------
			*/

			'memory_usage' => array(

				'warning' => 75,

				'danger' => 90,

			),

			/*
			|--------------------------------------------------------------------------
			| Upload Max Filesize (MB)
			|--------------------------------------------------------------------------
			*/

			'upload_max_filesize' => array(

				'danger' => 32,

				'warning' => 64,

				'success' => 128,

			),

			/*
			|--------------------------------------------------------------------------
			| Post Max Size (MB)
			|--------------------------------------------------------------------------
			*/

			'post_max_size' => array(

				'danger' => 32,

				'warning' => 64,

				'success' => 128,

			),

			/*
			|--------------------------------------------------------------------------
			| Max Execution Time (seconds)
			|--------------------------------------------------------------------------
			*/

			'max_execution_time' => array(

				'danger' => 60,

				'warning' => 120,

				'success' => 300,

			),

		);
	}

	/**
	 * Restituisce una soglia.
	 *
	 * @param string $key Chiave.
	 *
	 * @return array<string,mixed>
	 */
	public static function get(
		string $key
	): array {

		$thresholds = self::all();

		return $thresholds[ $key ] ?? array();

	}
}