<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\AdminModule;

use ArcticGaming\BasePresenter;


abstract class BaseAdminPresenter extends BasePresenter
{

	public function checkRequirements($element)
	{
		if (!($this->getUser()->isLoggedIn() && $this->getUser()->isAllowed('admin', 'access'))) {
			$this->redirect(':Public:Dashboard:default');
		}
	}


	public function isAdmin()
	{
		return TRUE;
	}
}
