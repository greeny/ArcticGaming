<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Repositories;

class TournamentRepository extends BaseRepository
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
