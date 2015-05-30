<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming;

use Nette\Application\UI\Presenter;

abstract class BasePresenter extends Presenter
{

	/** @var string @persistent */
	public $locale;

}
