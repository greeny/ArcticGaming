<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Repositories;

class GameRepository extends BaseRepository
{

	/**
	 * @return array
	 */
	public function getPairs()
	{
		return $this->getSelection('[id], [name]')
			->orderBy('[name] ASC')
			->fetchPairs('id', 'name');
	}
}
