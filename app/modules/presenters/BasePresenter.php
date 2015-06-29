<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming;

use ArcticGaming\Model\Entities\User;
use ArcticGaming\Model\Repositories\UserRepository;
use Nette\Application\UI\Presenter;
use Nette\Localization\ITranslator;


abstract class BasePresenter extends Presenter
{

	/** @var string @persistent */
	public $locale;

	/** @var string @persistent */
	public $back;

	/** @var ITranslator @inject */
	public $translator;

	/** @var UserRepository @inject */
	public $userRepository;

	/** @var User|NULL */
	protected $currentUser;


	public function startup()
	{
		parent::startup();
		if ($this->getUser()->isLoggedIn()) {
			if (!$this->currentUser = $this->userRepository->getById($this->getUser()->getId())) {
				$this->getUser()->logout(TRUE);
				$this->redirect('this');
			}
		}
	}


	public function beforeRender()
	{
		parent::beforeRender();
		$this->template->currentUser = $this->currentUser;
	}


	public function handleLogout()
	{
		if ($this->getUser()->isLoggedIn()) {
			$this->getUser()->logout(TRUE);
			$this->flashSuccess('messages.user.logout.success');
		}
		$this->redirect(':Public:Dashboard:default');
	}


	abstract public function isAdmin();


	protected function translatedFlashMessage($message, $args = NULL, $type = 'info')
	{
		return $this->flashMessage($this->translator->translate($message, $args), $type);
	}


	protected function flashSuccess($message, $args = NULL)
	{
		return $this->translatedFlashMessage($message, $args, 'success');
	}


	protected function flashError($message, $args = NULL)
	{
		return $this->translatedFlashMessage($message, $args, 'danger');
	}

}
