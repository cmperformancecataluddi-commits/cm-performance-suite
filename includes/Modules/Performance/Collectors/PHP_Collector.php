<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Performance\Collectors;

use CMPerformanceSuite\Contracts\Collector_Interface;

/**
 * Raccolta delle metriche PHP.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.1
 */
final class PHP_Collector implements Collector_Interface
{
	/**
	 * Restituisce le metriche PHP.
	 *
	 * @return array<string,mixed>
	 */
	public function collect(): array
	{
		return array(
			'version'              => PHP_VERSION,
			'memory_limit'         => ini_get( 'memory_limit' ),
			'memory_usage'         => memory_get_usage( true ),
			'peak_memory'          => memory_get_peak_usage( true ),
			'max_execution_time'   => (int) ini_get( 'max_execution_time' ),
			'upload_max_filesize'  => ini_get( 'upload_max_filesize' ),
			'post_max_size'        => ini_get( 'post_max_size' ),
			'opcache'              => extension_loaded( 'Zend OPcache' ),
			'jit'                  => ini_get( 'opcache.jit' ),
		);
	}
}