<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Forms;

use Nette\Application\UI\Form as NetteForm;
use Nette\Forms\Controls\BaseControl;


class Form extends NetteForm
{


	/**
	 * @param mixed $name
	 * @return BaseControl
	 */
	public function offsetGet($name)
	{
		return parent::offsetGet($name);
	}
}
