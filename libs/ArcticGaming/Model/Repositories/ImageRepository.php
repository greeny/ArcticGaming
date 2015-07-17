<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Repositories;

use ArcticGaming\Model\Entities\Image;


class ImageRepository extends BaseRepository
{

	/**
	 * @param $id
	 * @return Image|NULL
	 */
	public function getById($id)
	{
		return $this->tryCreateEntity(
			$this->getSelection()
				->where('[id] = ?', $id)
				->fetch()
		);
	}
}
