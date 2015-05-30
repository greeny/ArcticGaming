<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Forms\User;

use ArcticGaming\Forms\BaseForm;
use ArcticGaming\Forms\Form;
use ArcticGaming\Model\Repositories\UserRepository;


class RegisterForm extends BaseForm
{

	/** @var UserRepository */
	private $userRepository;


	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function initialize(Form $form)
	{
		$form->addText('nick', 'forms.register.fields.nick')
			->setRequired('forms.register.errors.nick.required')
			->addRule($form::PATTERN, 'forms.register.errors.nick.invalid', '[a-zA-Z0-9\\-]+');

		$form->addPassword('password', 'forms.register.fields.password')
			->setRequired('forms.register.errors.password.required');

		$form->addPassword('passwordCheck', 'forms.register.fields.passwordCheck')
			->setRequired('forms.register.errors.passwordCheck.required')
			->addRule($form::EQUAL, 'forms.register.errors.passwordCheck.notMatching', $form['password']);

		$form->addText('email', 'forms.register.fields.email')
			->setType('email')
			->setRequired('forms.register.errors.email.required')
			->addRule($form::EMAIL, 'forms.register.errors.email.invalid');

		$form->addSubmit('register', 'forms.register.fields.submit');
	}


	public function validateData(Form $form)
	{
		$values = $form->getValues();

		if (!$this->userRepository->getByNick($values->nick)) {
			$form['nick']->addError(
				$this->translator->translate('forms.register.errors.nick.duplicate', ['nick' => $values->nick])
			);
		}
	}


	public function formSuccess(Form $form)
	{
		$values = $form->getValues();
		$this->userRepository->registerUser($values->nick, $values->password, $values->email);
	}
}
