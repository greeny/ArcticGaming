<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\AdminModule;

use ArcticGaming\Forms\Admin\User\CreateUserForm;
use ArcticGaming\Model\Entities\User;
use ArcticGaming\Model\Repositories\UserRepository;


class UserPresenter extends BaseAdminPresenter
{
	/** @var UserRepository @inject */
	public $userRepository;

	/** @var CreateUserForm @inject */
	public $createUserForm;

	/** @var User[] */
	private $users;


	public function actionDefault()
	{
		$this->users = $this->userRepository->getAll();
	}


	public function renderDefault()
	{
		$this->template->users = $this->users;
	}


	protected function createComponentCreateUserForm()
	{
		$form = $this->createUserForm->create();
		$form->onSuccess[] = $this->createUserFormSuccess;
		return $form;
	}


	public function createUserFormSuccess()
	{
		$this->flashSuccess('messages.admin.user.create.success');
		$this->redirect('default');
	}
}
