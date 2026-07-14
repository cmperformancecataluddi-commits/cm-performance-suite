<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance\Collectors;

use CMPerformanceSuite\Contracts\Collector_Interface;

/**
 * Raccolta delle metriche del server.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Server_Collector implements Collector_Interface
{
	/**
	 * Restituisce le metriche del server.
	 *
	 * @return array<string,mixed>
	 */
	public function collect(): array
	{
		global $wpdb;

		return array(

			/*
			|--------------------------------------------------------------------------
			| Sistema Operativo
			|--------------------------------------------------------------------------
			*/

			'operating_system' => PHP_OS_FAMILY,
			'architecture'     => php_uname( 'm' ),
			'hostname'         => php_uname( 'n' ),

			/*
			|--------------------------------------------------------------------------
			| Web Server
			|--------------------------------------------------------------------------
			*/

			'web_server' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/D',
			'php_sapi'   => PHP_SAPI,
			'https'      => is_ssl(),
			'http2'      => isset( $_SERVER['SERVER_PROTOCOL'] )
				&& false !== stripos( $_SERVER['SERVER_PROTOCOL'], '2' ),

			/*
			|--------------------------------------------------------------------------
			| Compressione e Cache
			|--------------------------------------------------------------------------
			*/

			'zlib'         => extension_loaded( 'zlib' ),
			'opcache'      => function_exists( 'opcache_get_status' ),
			'object_cache' => wp_using_ext_object_cache(),
			'redis'        => class_exists( 'Redis' ),
			'memcached'    => class_exists( 'Memcached' ),

			/*
			|--------------------------------------------------------------------------
			| Database
			|--------------------------------------------------------------------------
			*/

			'database'      => $wpdb->db_server_info(),
			'mysql_version' => $wpdb->db_version(),

			/*
			|--------------------------------------------------------------------------
			| Sistema
			|--------------------------------------------------------------------------
			*/

			'timezone' => date_default_timezone_get(),

		);
	}
}