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
	 * Hook della dashboard.
	 *
	 * @var string
	 */
	private string $page_hook = '';

	/**
	 * Hook del Performance Monitor.
	 *
	 * @var string
	 */
	private string $performance_hook = '';

	/**
	 * Dashboard.
	 *
	 * @var Dashboard
	 */
	private Dashboard $dashboard;

	/**
	 * Performance Monitor.
	 *
	 * @var Performance_Page
	 */
	private Performance_Page $performance;

	/**
	 * Costruttore.
	 */
	public function __construct()
	{
		$this->dashboard   = new Dashboard();
		$this->performance = new Performance_Page();

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

		$this->performance_hook = add_submenu_page(
			'cm-performance-suite',
			__( 'Performance Monitor', 'cm-performance-suite' ),
			__( 'Performance Monitor', 'cm-performance-suite' ),
			'manage_options',
			'cm-performance-monitor',
			array( $this, 'render_performance' )
		);
	}

	/**
	 * Carica CSS e JS solo nelle pagine della suite.
	 *
	 * @param string $hook Hook della pagina.
	 *
	 * @return void
	 */
	public function enqueue_assets( string $hook ): void
	{
		if (
			$hook !== $this->page_hook &&
			$hook !== $this->performance_hook
		) {
			return;
		}

		Asset_Manager::enqueue_style(
			'cmps-design-system',
			'css/design-system.css'
		);

		Asset_Manager::enqueue_style(
			'cmps-layout',
			'css/layout.css'
		);

		Asset_Manager::enqueue_style(
			'cmps-components',
			'css/components.css'
		);

		Asset_Manager::enqueue_style(
			'cmps-animations',
			'css/animations.css'
		);

		Asset_Manager::enqueue_style(
			'cmps-responsive',
			'css/responsive.css'
		);

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

	/**
	 * Renderizza il Performance Monitor.
	 *
	 * @return void
	 */
	public function render_performance(): void
	{
		$this->performance->render();
	}
}