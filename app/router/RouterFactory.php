<?php

namespace ArcticGaming\Router;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


class RouterFactory
{

	/**
	 * @return IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;
		$router[] = new Route('', [
			'module' => 'Public',
			'presenter' => 'Dashboard',
			'action' => 'default',
			'locale' => 'cs',
		], Route::ONE_WAY);
		$router[] = new Route('<locale cs|en>/admin/<presenter>/<action>[/<id>]', [
			'module' => 'Admin',
			'presenter' => 'Dashboard',
			'action' => 'default',
		]);
		$router[] = new Route('<locale cs|en>/game/<slug>', [
			'module' => 'Public',
			'presenter' => 'Game',
			'action' => 'detail',
		]);
		$router[] = new Route('<locale cs|en>/<presenter>/<action>[/<id>]', [
			'module' => 'Public',
			'presenter' => 'Dashboard',
			'action' => 'default',
		]);
		return $router;
	}

}
