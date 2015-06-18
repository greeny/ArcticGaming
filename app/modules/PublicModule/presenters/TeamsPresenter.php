<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\PublicModule;

use ArcticGaming\Model\Entities\Team;
use ArcticGaming\Model\Repositories\TeamRepository;


class TeamsPresenter extends BasePublicPresenter
{
	/** @var TeamRepository @inject */
	public $teamRepository;

	/** @var Team[] */
	private $teams;


	public function actionDefault()
	{
		$this->teams = $this->teamRepository->getAll();
	}


	public function renderDefault()
	{
		$this->template->teams = $this->teams;
	}
}
