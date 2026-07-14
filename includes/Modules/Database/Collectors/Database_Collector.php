<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Modules\Database\Collectors;

use CMPerformanceSuite\Contracts\Collector_Interface;

/**
 * Raccolta delle metriche del database.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.5
 */
final class Database_Collector implements Collector_Interface
{
	/**
	 * Restituisce le metriche del database.
	 *
	 * @return array<string,mixed>
	 */
	public function collect(): array
	{
		global $wpdb;

		$tables = $wpdb->get_results(
			'SHOW TABLE STATUS',
			ARRAY_A
		);

		if ( ! is_array( $tables ) ) {
			$tables = array();
		}

		$total_size       = 0;
		$total_data       = 0;
		$total_indexes    = 0;
		$total_overhead   = 0;
		$total_rows       = 0;
		$engines          = array();
		$normalized_tables = array();

		foreach ( $tables as $table ) {

			$data_length  = (int) ( $table['Data_length'] ?? 0 );
			$index_length = (int) ( $table['Index_length'] ?? 0 );
			$data_free    = (int) ( $table['Data_free'] ?? 0 );
			$rows         = (int) ( $table['Rows'] ?? 0 );
			$engine       = (string) ( $table['Engine'] ?? '' );

			$total_data     += $data_length;
			$total_indexes  += $index_length;
			$total_overhead += $data_free;
			$total_rows     += $rows;
			$total_size     += $data_length + $index_length;

			if ( '' !== $engine ) {
				$engines[ $engine ] = ( $engines[ $engine ] ?? 0 ) + 1;
			}

			$normalized_tables[] = array(
				'name'           => (string) ( $table['Name'] ?? '' ),
				'engine'         => $engine,
				'rows'           => $rows,
				'data_length'    => $data_length,
				'index_length'   => $index_length,
				'total_size'     => $data_length + $index_length,
				'data_free'      => $data_free,
				'auto_increment' => isset( $table['Auto_increment'] )
					? (int) $table['Auto_increment']
					: null,
				'collation'      => (string) ( $table['Collation'] ?? '' ),
				'create_time'    => (string) ( $table['Create_time'] ?? '' ),
				'update_time'    => (string) ( $table['Update_time'] ?? '' ),
			);
		}

		$main_engine = '';

		if ( ! empty( $engines ) ) {
			arsort( $engines );
			$main_engine = (string) array_key_first( $engines );
		}

		$revision_count = (int) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(ID)
				FROM {$wpdb->posts}
				WHERE post_type = %s",
				'revision'
			)
		);

		$transient_count = (int) $wpdb->get_var(
			"SELECT COUNT(option_id)
			FROM {$wpdb->options}
			WHERE option_name LIKE '\_transient\_%'
			OR option_name LIKE '\_site\_transient\_%'"
		);

		$autoload_size = (int) $wpdb->get_var(
			"SELECT COALESCE(SUM(LENGTH(option_value)), 0)
			FROM {$wpdb->options}
			WHERE autoload IN ('yes', 'on', 'auto-on', 'auto')"
		);

		$cron_option = get_option( 'cron', array() );
		$cron_events = 0;

		if ( is_array( $cron_option ) ) {
			foreach ( $cron_option as $timestamp => $hooks ) {

				if ( 'version' === $timestamp || ! is_array( $hooks ) ) {
					continue;
				}

				foreach ( $hooks as $events ) {
					if ( is_array( $events ) ) {
						$cron_events += count( $events );
					}
				}
			}
		}

		$woocommerce_active = class_exists( 'WooCommerce' );

		$woocommerce = array(
			'active'            => $woocommerce_active,
			'sessions'          => 0,
			'pending_actions'   => 0,
			'failed_actions'    => 0,
			'pending_orders'    => 0,
			'failed_orders'     => 0,
		);

		if ( $woocommerce_active ) {

			$sessions_table = $wpdb->prefix . 'woocommerce_sessions';

			if ( $this->table_exists( $sessions_table ) ) {
				$woocommerce['sessions'] = (int) $wpdb->get_var(
					"SELECT COUNT(*)
					FROM `{$sessions_table}`"
				);
			}

			$actions_table = $wpdb->prefix . 'actionscheduler_actions';

			if ( $this->table_exists( $actions_table ) ) {

				$woocommerce['pending_actions'] = (int) $wpdb->get_var(
					"SELECT COUNT(*)
					FROM `{$actions_table}`
					WHERE status = 'pending'"
				);

				$woocommerce['failed_actions'] = (int) $wpdb->get_var(
					"SELECT COUNT(*)
					FROM `{$actions_table}`
					WHERE status = 'failed'"
				);
			}

			$woocommerce['pending_orders'] = $this->count_orders_by_status(
				'wc-pending'
			);

			$woocommerce['failed_orders'] = $this->count_orders_by_status(
				'wc-failed'
			);
		}

		return array(
			'database' => array(
				'name'           => (string) $wpdb->dbname,
				'tables'         => count( $normalized_tables ),
				'rows'           => $total_rows,
				'size'           => $total_size,
				'data_size'      => $total_data,
				'index_size'     => $total_indexes,
				'overhead'       => $total_overhead,
				'charset'        => (string) $wpdb->charset,
				'collation'      => (string) $wpdb->collate,
				'main_engine'    => $main_engine,
				'engine_counts'  => $engines,
			),

			'tables' => $normalized_tables,

			'wordpress' => array(
				'revisions'      => $revision_count,
				'transients'     => $transient_count,
				'autoload_size'  => $autoload_size,
				'cron_events'    => $cron_events,
			),

			'woocommerce' => $woocommerce,
		);
	}

	/**
	 * Verifica se una tabella esiste.
	 *
	 * @param string $table_name Nome della tabella.
	 *
	 * @return bool
	 */
	private function table_exists(
		string $table_name
	): bool {

		global $wpdb;

		$result = $wpdb->get_var(
			$wpdb->prepare(
				'SHOW TABLES LIKE %s',
				$wpdb->esc_like( $table_name )
			)
		);

		return $table_name === $result;
	}

	/**
	 * Conta gli ordini WooCommerce per stato.
	 *
	 * Supporta sia la struttura classica sia HPOS.
	 *
	 * @param string $status Stato dell'ordine.
	 *
	 * @return int
	 */
	private function count_orders_by_status(
		string $status
	): int {

		global $wpdb;

		$orders_table = $wpdb->prefix . 'wc_orders';

		if ( $this->table_exists( $orders_table ) ) {

			return (int) $wpdb->get_var(
				$wpdb->prepare(
					"SELECT COUNT(id)
					FROM `{$orders_table}`
					WHERE status = %s",
					$status
				)
			);
		}

		return (int) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(ID)
				FROM {$wpdb->posts}
				WHERE post_type = 'shop_order'
				AND post_status = %s",
				$status
			)
		);
	}
}