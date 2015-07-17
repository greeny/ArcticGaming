<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Forms\Admin\User;

use ArcticGaming\Forms\Form;
use ArcticGaming\Forms\User\BaseUserCreateForm;
use ArcticGaming\Model\Entities\User;


class EditUserForm extends BaseUserCreateForm
{

	/** @var User */
	private $user;


	public function setUser(User $user)
	{
		$this->user = $user;
	}

	public function initialize(Form $form)
	{
		parent::initialize($form);
		$form['register']->caption = $this->translator->translate('forms.editUser.fields.edit');
	}
}
