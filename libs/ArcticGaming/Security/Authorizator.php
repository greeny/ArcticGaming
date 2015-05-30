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

}
