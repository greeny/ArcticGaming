<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Forms\User;

use ArcticGaming\Forms\BaseForm;
use ArcticGaming\Forms\Form;
use ArcticGaming\Model\Repositories\UserRepository;
use Nette\Security\Identity;
use Nette\Security\Passwords;
use Nette\Security\User;


class LoginForm extends BaseForm
{

	/** @var User */
	private $user;

	/** @var UserRepository */
	private $userRepository;

	/** @var \ArcticGaming\Model\Entities\User */
	private $userEntity;


	public function __construct(User $user, UserRepository $userRepository)
	{
		$this->user = $user;
		$this->userRepository = $userRepository;
	}

	public function initialize(Form $form)
	{
		$form->addText('nick', 'forms.login.fields.nick')
			->setRequired('forms.login.errors.nick.required');

		$form->addPassword('password', 'forms.login.fields.password')
			->setRequired('forms.login.errors.password.required');

		$form->addSubmit('login', 'forms.login.fields.submit');
	}


	public function validateData(Form $form)
	{
		$values = $form->getValues();

		if (!$user = $this->userRepository->getByNick($values->nick)) {
			$user = $this->userRepository->getByEmail($values->nick);
		}

		if (!$user) {
			$form['nick']->addError('forms.login.errors.nick.invalid');
		}
		if (!Passwords::verify($values->password, $user->password)) {
			$form['password']->addError('forms.login.errors.password.invalid');
		}

		$this->userEntity = $user;
	}


	public function formSuccess(Form $form)
	{
		$this->user->login(new Identity($this->userEntity->id, $this->userEntity->role, []));
	}
}
