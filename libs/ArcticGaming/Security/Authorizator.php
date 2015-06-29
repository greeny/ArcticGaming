<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Security;

use Nette\Security\Permission;


class Authorizator extends Permission
{

	const ROLE_QUEST = 'quest';
	const ROLE_MEMBER = 'member';
	const ROLE_PLAYER = 'player';
	const ROLE_ADMIN = 'admin';
	const ROLE_OWNER = 'owner';

	const RESOURCE_ADMINISTRATION = 'admin';


	public function __construct()
	{
		$this->addRole(self::ROLE_QUEST);
		$this->addRole(self::ROLE_MEMBER, self::ROLE_QUEST);
		$this->addRole(self::ROLE_PLAYER, self::ROLE_MEMBER);
		$this->addRole(self::ROLE_ADMIN, self::ROLE_PLAYER);
		$this->addRole(self::ROLE_OWNER);

		$this->addResource(self::RESOURCE_ADMINISTRATION);

		$this->allow([self::ROLE_ADMIN, self::ROLE_OWNER], self::RESOURCE_ADMINISTRATION);
	}

}
