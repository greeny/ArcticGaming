<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\PublicModule;

use ArcticGaming\BasePresenter;

abstract class BasePublicPresenter extends BasePresenter
{

	public function isAdmin()
	{
		return FALSE;
	}
}
