<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Admin;

use CMPerformanceSuite\Application\Asset_Manager;

/**
 * Gestione dell'area amministrativa della CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.2
 */
final class Admin
{
	/**
	 * Hook della pagina amministrativa.
	 *
	 * @var string
	 */
	private string $page_hook = '';

	/**
	 * Dashboard.
	 *
	 * @var Dashboard
	 */
	private Dashboard $dashboard;

	/**
	 * Costruttore.
	 */
	public function __construct()
	{
		$this->dashboard = new Dashboard();

		add_action(
			'admin_menu',
			array( $this, 'register_menu' )
		);

		add_action(
			'admin_enqueue_scripts',
			array( $this, 'enqueue_assets' )
		);
	}

	/**
	 * Registra il menu principale.
	 *
	 * @return void
	 */
	public function register_menu(): void
	{
		$this->page_hook = add_menu_page(
			__( 'CM Performance Suite', 'cm-performance-suite' ),
			__( 'CM Performance Suite', 'cm-performance-suite' ),
			'manage_options',
			'cm-performance-suite',
			array( $this, 'render_dashboard' ),
			'dashicons-superhero',
			58
		);
	}

	/**
	 * Carica CSS e JS solo nella dashboard.
	 *
	 * @param string $hook Hook della pagina.
	 *
	 * @return void
	 */
	public function enqueue_assets( string $hook ): void
	{
		if ( $hook !== $this->page_hook ) {
			return;
		}

		Asset_Manager::enqueue_style(
			'cmps-admin',
			'css/admin.css'
		);

		Asset_Manager::enqueue_script(
			'cmps-admin',
			'js/admin.js'
		);
	}

	/**
	 * Renderizza la dashboard.
	 *
	 * @return void
	 */
	public function render_dashboard(): void
	{
		$this->dashboard->render();
	}
}