<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Translation;


use Nette\Localization\ITranslator;


class DateTimeFormatter
{

	/** @var ITranslator */
	private $translator;


	public function __construct(ITranslator $translator)
	{
		$this->translator = $translator;
	}


	public function formatDate($stamp)
	{
		return date($this->translator->translate('utils.date.dateFormat'), $stamp);
	}


	public function formatTime($stamp)
	{
		return date($this->translator->translate('utils.date.timeFormat'), $stamp);
	}


	public function formatDateTime($stamp)
	{
		return date($this->translator->translate('utils.date.dateTimeFormat'), $stamp);
	}

}
