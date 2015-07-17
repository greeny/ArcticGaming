<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Forms\Admin\User;

use ArcticGaming\Forms\Form;
use ArcticGaming\Forms\User\BaseUserCreateForm;


class CreateUserForm extends BaseUserCreateForm
{

	public function initialize(Form $form)
	{
		parent::initialize($form);
		$form['register']->caption = $this->translator->translate('forms.createUser.fields.create');
	}
}
