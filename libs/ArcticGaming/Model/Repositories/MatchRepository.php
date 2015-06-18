<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Repositories;

use Nette\Utils\Paginator;


class MatchRepository extends BaseRepository
{

	/**
	 * @return int
	 */
	public function countAll()
	{
		return $this->getSelection('COUNT(*) AS [count]')->fetch()->count;
	}

	public function getByPaginator(Paginator $paginator)
	{
		return $this->createEntities(
			$this->getSelection()
				->fetchAll($paginator->offset, $paginator->length)
		);
	}


	public function getFeatured()
	{
		return $this->createEntities(
			$this->getSelection()
				->where('[result_home] IS NULL')
				->where('[result_opponent] IS NULL')
				->orderBy('[start] ASC')
				->limit(5)
				->fetchAll()
		);
	}
}
