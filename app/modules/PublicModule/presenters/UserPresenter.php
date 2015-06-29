<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\PublicModule;

use ArcticGaming\Forms\Form;
use ArcticGaming\Forms\User\LoginForm;
use ArcticGaming\Forms\User\RegisterForm;
use ArcticGaming\Model\Entities\User;
use Nette\Security\Identity;


class UserPresenter extends BasePublicPresenter
{

	/** @var RegisterForm @inject */
	public $registerForm;

	/** @var LoginForm @inject */
	public $loginForm;

	/** @var User */
	private $profile;


	public function actionRegister()
	{
		if ($this->getUser()->isLoggedIn()) {
			$this->redirect('profile');
		}
	}


	public function actionLogin()
	{
		if ($this->getUser()->isLoggedIn()) {
			$this->redirect('profile');
		}
	}


	public function actionProfile($id = NULL)
	{
		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect('login', ['back' => $this->storeRequest()]);
		}

		if ($id && $id === $this->getUser()->getId()) {
			$this->redirect('this', ['id' => NULL]);
		}

		if (!$this->profile = $id ? $this->userRepository->getById($id) : $this->currentUser) {
			$this->redirect('Dashboard:default');
		}
	}


	public function renderProfile()
	{
		$this->template->profile = $this->profile;
		$this->template->isOwnProfile = $this->profile->id === $this->getUser()->getId();
	}


	protected function createComponentRegisterForm()
	{
		$form = $this->registerForm->create();
		$form->onSuccess[] = $this->registerFormSuccess;
		return $form;
	}


	public function registerFormSuccess(Form $form)
	{
		$user = $this->userRepository->getByNick($form->getValues()->nick);
		$this->getUser()->login(new Identity($user->id, $user->role, []));
		$this->flashSuccess('messages.user.register.success');
		if ($this->back) {
			$this->restoreRequest($this->back);
		}
		$this->redirect('profile');
	}


	protected function createComponentLoginForm()
	{
		$form = $this->loginForm->create();
		$form->onSuccess[] = $this->loginFormSuccess;
		return $form;
	}


	public function loginFormSuccess(Form $form)
	{
		$this->flashSuccess('messages.user.login.success');
		if ($this->back) {
			$this->restoreRequest($this->back);
		}
		$this->redirect('profile');
	}

}
