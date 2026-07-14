<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\Enums;

/**
 * Stati standard utilizzati dalla CM Performance Suite.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.3
 */
enum Status: string
{
	case SUCCESS = 'success';

	case WARNING = 'warning';

	case DANGER = 'danger';

	case INFO = 'info';

	case NEUTRAL = 'neutral';

	/**
	 * Verifica se lo stato è positivo.
	 *
	 * @return bool
	 */
	public function is_success(): bool
	{
		return self::SUCCESS === $this;
	}

	/**
	 * Verifica se lo stato è di avviso.
	 *
	 * @return bool
	 */
	public function is_warning(): bool
	{
		return self::WARNING === $this;
	}

	/**
	 * Verifica se lo stato è critico.
	 *
	 * @return bool
	 */
	public function is_danger(): bool
	{
		return self::DANGER === $this;
	}

	/**
	 * Restituisce la classe CSS associata.
	 *
	 * @return string
	 */
	public function css_class(): string
	{
		return 'cmps-status--' . $this->value;
	}

	/**
	 * Restituisce il badge CSS associato.
	 *
	 * @return string
	 */
	public function badge_class(): string
	{
		return 'cmps-badge--' . $this->value;
	}
}