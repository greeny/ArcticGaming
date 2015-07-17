<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Model\Repositories;

use ArcticGaming\Forms\Match\FilterForm;
use ArcticGaming\Model\Entities\Match;
use DibiFluent;
use Nette\Utils\Paginator;


class MatchRepository extends BaseRepository
{

	/**
	 * @param array $filter
	 * @return int
	 */
	public function countByFilter($filter)
	{
		$selection = $this->getSelection('COUNT([m].[id]) AS [count]');
		$this->modifySelectionByFilter($selection, $filter);
		return $selection->fetch()->count;
	}


	/**
	 * @param array $filter
	 * @param Paginator $paginator
	 * @return Match[]
	 */
	public function getByFilter($filter, Paginator $paginator)
	{
		$selection = $this->getSelection();
		$this->modifySelectionByFilter($selection, $filter);
		return $this->createEntities(
			$selection
				->orderBy('[start] ASC')
				->fetchAll($paginator->offset, $paginator->length)
		);
	}


	/**
	 * @return Match[]
	 */
	public function getFeatured()
	{
		return $this->createEntities(
			parent::getSelection()
				->where('[result_home] IS NULL')
				->where('[result_opponent] IS NULL')
				->orderBy('[start] ASC')
				->limit(5)
				->fetchAll()
		);
	}


	protected function getSelection($select = '[m].*')
	{
		return $this->connection->select($select)
			->from('[' . $this->getTable() . '] [m]')
			->leftJoin('[team] [t]')
			->on('[m].[team_id] = [t].[id]');
	}

	private function modifySelectionByFilter(DibiFluent $selection, $filter)
	{
		if ($filter['game']) {
			$selection->where('[t].[game_id] = ?', $filter['game']);
		}
		if ($filter['opponent']) {
			$selection->where('[opponent_id] = ?', $filter['opponent']);
		}
		if ($filter['tournament']) {
			$selection->where('[tournament_id] = ?', $filter['tournament']);
		}
		if ($filter['result']) {
			switch ($filter['result']) {
				case FilterForm::WON_GAMES:
					$selection->where('[result_home] > [result_opponent]');
					break;
				case FilterForm::LOST_GAMES:
					$selection->where('[result_home] < [result_opponent]');
					break;
				case FilterForm::DRAW_GAMES:
					$selection->where('[result_home] = [result_opponent]');
					break;
				case FilterForm::WITHOUT_RESULT_GAMES:
					$selection->where('[result_home] IS NULL')
						->where('[result_opponent] IS NULL');
					break;
			}
		}
	}
}
