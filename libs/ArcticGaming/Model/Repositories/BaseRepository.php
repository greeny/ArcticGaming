<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Repositories;

use LeanMapper\Repository;


abstract class BaseRepository extends Repository
{

	/**
	 * @param $row
	 * @return mixed|null
	 */
	protected function tryCreateEntity($row)
	{
		return $row ? $this->createEntity($row) : NULL;
	}


	/**
	 * @param string $select
	 * @return \DibiFluent
	 */
	protected function getSelection($select = '*')
	{
		return $this->connection->select($select)
			->from($this->getTable());
	}

}
