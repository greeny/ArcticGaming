<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Forms;

use Nette\Forms\Controls\Button;
use Nette\Forms\Controls\Checkbox;
use Nette\Forms\Controls\CheckboxList;
use Nette\Forms\Controls\MultiSelectBox;
use Nette\Forms\Controls\RadioList;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Controls\TextBase;
use Nette\Forms\Rendering\DefaultFormRenderer;
use Nette\Localization\ITranslator;


abstract class BaseForm
{

	/** @var ITranslator */
	protected $translator;


	public function setTranslator(ITranslator $translator)
	{
		$this->translator = $translator;
	}

	public function create()
	{
		$form = new Form;

		$form->setTranslator($this->translator);

		$this->initialize($form);

		$form->onValidate[] = [$this, 'validateData'];
		$form->onSuccess[] = [$this, 'formSuccess'];

		/** @var DefaultFormRenderer $renderer */
		$renderer = $form->getRenderer();
		$renderer->wrappers['controls']['container'] = NULL;
		$renderer->wrappers['pair']['container'] = 'div class=form-group';
		$renderer->wrappers['pair']['.error'] = 'has-error';
		$renderer->wrappers['control']['container'] = 'div class=col-sm-9';
		$renderer->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
		$renderer->wrappers['control']['description'] = 'span class=help-block';
		$renderer->wrappers['control']['errorcontainer'] = 'span class=help-block';
		$form->getElementPrototype()->class('form-horizontal');
		foreach ($form->getControls() as $control) {
			if ($control instanceof Button) {
				$control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
				$usedPrimary = TRUE;
			} elseif ($control instanceof TextBase || $control instanceof SelectBox || $control instanceof MultiSelectBox) {
				$control->getControlPrototype()->addClass('form-control');
			} elseif ($control instanceof Checkbox || $control instanceof CheckboxList || $control instanceof RadioList) {
				$control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
			}
		}

		return $form;
	}

	abstract public function initialize(Form $form);
	abstract public function validateData(Form $form);
	abstract public function formSuccess(Form $form);
}
