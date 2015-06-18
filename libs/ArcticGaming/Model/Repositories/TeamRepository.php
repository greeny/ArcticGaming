<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Repositories;

use ArcticGaming\Model\Entities\Team;


class TeamRepository extends BaseRepository
{

	/**
	 * @return Team[]
	 */
	public function getAll()
	{
		return $this->createEntities($this->getSelection()->fetchAll());
	}
}
