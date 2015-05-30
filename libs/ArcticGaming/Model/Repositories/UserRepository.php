<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Repositories;

use ArcticGaming\Model\Entities\User;
use ArcticGaming\Security\Authorizator;
use DibiDriverException;
use Nette\Security\Passwords;


class UserRepository extends BaseRepository
{

	/**
	 * @param string $nick
	 * @return User|NULL
	 */
	public function getByNick($nick)
	{
		return $this->tryCreateEntity(
			$this->getSelection()
				->where('[nick] = ?', $nick)
				->fetch()
		);
	}


	/**
	 * @param string $email
	 * @return User|NULL
	 */
	public function getByEmail($email)
	{
		return $this->tryCreateEntity(
			$this->getSelection()
				->where('[email] = ?', $email)
				->fetch()
		);
	}


	/**
	 * @param string $nick
	 * @param string $password
	 * @param string $email
	 * @param string $role
	 * @return User|NULL
	 */
	public function registerUser($nick, $password, $email, $role = Authorizator::ROLE_MEMBER)
	{
		$user = new User;
		$user->nick = $nick;
		$user->password = Passwords::hash($password);
		$user->email = $email;
		$user->role = $role;
		try {
			$this->persist($user);
			return $this->getByNick($user->nick);
		} catch (DibiDriverException $e) {
			return NULL;
		}
	}
}
