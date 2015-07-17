<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Templating;

use ArcticGaming\Translation\DateTimeFormatter;
use Latte\Engine;


class Helpers
{

	/** @var DateTimeFormatter */
	private $dateTimeFormatter;


	public function __construct(DateTimeFormatter $dateTimeFormatter)
	{
		$this->dateTimeFormatter = $dateTimeFormatter;
	}

	public function register(Engine $engine)
	{
		$dateTimeFormatter = $this->dateTimeFormatter;
		$engine->addFilter('date', function ($stamp) use ($dateTimeFormatter) {
			return $dateTimeFormatter->formatDate($stamp);
		});
		$engine->addFilter('datetime', function ($stamp) use ($dateTimeFormatter) {
			return $dateTimeFormatter->formatDateTime($stamp);
		});
		$engine->addFilter('time', function ($stamp) use ($dateTimeFormatter) {
			return $dateTimeFormatter->formatTime($stamp);
		});
	}
}
