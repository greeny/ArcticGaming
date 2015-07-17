<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\AdminModule;

use ArcticGaming\Forms\Admin\User\CreateUserForm;
use ArcticGaming\Forms\Form;
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

	/** @var User */
	private $u;


	public function actionDefault()
	{
		$this->users = $this->userRepository->getAll();
	}


	public function renderDefault()
	{
		$this->template->users = $this->users;
	}


	public function actionEdit($id)
	{
		if (!$this->u = $this->userRepository->getById($id)) {
			$this->redirect('default');
		}
	}


	protected function createComponentCreateUserForm()
	{
		$form = $this->createUserForm->create();
		$form->onSuccess[] = $this->createUserFormSuccess;
		return $form;
	}


	public function createUserFormSuccess(Form $form)
	{
		$this->flashSuccess('messages.admin.user.create.success');
		$this->redirect('default');
	}


	protected function createComponentEditUserForm()
	{

	}
}
