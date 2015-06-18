<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model;

use LeanMapper\Connection;
use LeanMapper\Fluent;
use Nette\Object;


class Filters extends Object
{

	public static function register(Connection $connection)
	{
		foreach (self::getReflection()->getMethods() as $method) {
			if ($method->getName() !== 'register') {
				$connection->registerFilter($method->getName(), 'ArcticGaming\\Model\\Filters::' . $method->getName());
			}
		}
	}

	public static function orderMembers(Fluent $fluent)
	{
		$fluent->orderBy('[order] ASC');
	}
}
