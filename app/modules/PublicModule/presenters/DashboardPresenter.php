<?php

namespace ArcticGaming\PublicModule;


use ArcticGaming\Forms\User\RegisterForm;


class DashboardPresenter extends BasePublicPresenter
{

	/** @var RegisterForm @inject */
	public $registerForm;

	protected function createComponentRegisterUserForm()
	{
		$form = $this->registerForm->create();
		return $form;
	}
}
