<?php

declare(strict_types=1);

namespace CMPerformanceSuite\Application\DTO;

use CMPerformanceSuite\Application\Enums\Status;

/**
 * Rappresenta il risultato di un'analisi eseguita dal Core Engine.
 *
 * Tutti gli Analyzer della CM Performance Suite devono
 * restituire un'istanza di questa classe.
 *
 * @package CMPerformanceSuite
 * @since 1.1.0-alpha.4
 */
final class Analysis_Result
{
	private string $title;

	private string $value;

	private Status $status;

	private int $score;

	private string $message;

	private ?string $recommendation;

	public function __construct(
		string $title,
		string $value,
		Status $status,
		int $score,
		string $message,
		?string $recommendation = null
	) {
		$this->title          = $title;
		$this->value          = $value;
		$this->status         = $status;
		$this->score          = max( 0, min( 100, $score ) );
		$this->message        = $message;
		$this->recommendation = $recommendation;
	}

	public function title(): string
	{
		return $this->title;
	}

	public function value(): string
	{
		return $this->value;
	}

	public function status(): Status
	{
		return $this->status;
	}

	public function score(): int
	{
		return $this->score;
	}

	public function message(): string
	{
		return $this->message;
	}

	public function recommendation(): ?string
	{
		return $this->recommendation;
	}

	public function has_recommendation(): bool
	{
		return null !== $this->recommendation
			&& '' !== trim( $this->recommendation );
	}

	/**
	 * @return array<string,mixed>
	 */
	public function to_array(): array
	{
		return array(
			'title'          => $this->title(),
			'value'          => $this->value(),
			'status'         => $this->status()->value,
			'score'          => $this->score(),
			'message'        => $this->message(),
			'recommendation' => $this->recommendation(),
		);
	}
}