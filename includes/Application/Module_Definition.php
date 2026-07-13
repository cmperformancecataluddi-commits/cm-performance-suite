<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application;

/**
 * Definizione di un modulo registrato.
 *
 * Contiene esclusivamente i metadati del modulo.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.2
 */
final class Module_Definition
{
	/**
	 * ID del modulo.
	 *
	 * @var string
	 */
	private string $id;

	/**
	 * Nome del modulo.
	 *
	 * @var string
	 */
	private string $name;

	/**
	 * Descrizione del modulo.
	 *
	 * @var string
	 */
	private string $description;

	/**
	 * Versione del modulo.
	 *
	 * @var string
	 */
	private string $version;

	/**
	 * Stato del modulo.
	 *
	 * @var bool
	 */
	private bool $enabled;

	/**
	 * Badge del modulo.
	 *
	 * @var string
	 */
	private string $badge;

	/**
	 * Costruttore.
	 *
	 * @param array<string,mixed> $data Dati del modulo.
	 */
	public function __construct(array $data)
	{
		$this->id = (string) ($data['id'] ?? '');

		$this->name = (string) ($data['name'] ?? '');

		$this->description = (string) ($data['description'] ?? '');

		$this->version = (string) ($data['version'] ?? '');

		$this->enabled = (bool) ($data['status'] ?? false);

		$this->badge = (string) ($data['badge'] ?? 'stable');
	}

	public function get_id(): string
	{
		return $this->id;
	}

	public function get_name(): string
	{
		return $this->name;
	}

	public function get_description(): string
	{
		return $this->description;
	}

	public function get_version(): string
	{
		return $this->version;
	}

	public function get_badge(): string
	{
		return $this->badge;
	}

	public function is_enabled(): bool
	{
		return $this->enabled;
	}
}