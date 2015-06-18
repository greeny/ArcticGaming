<?php

namespace ArcticGaming\PublicModule;


use ArcticGaming\Model\Entities\Match;
use ArcticGaming\Model\Repositories\MatchRepository;


class DashboardPresenter extends BasePublicPresenter
{

	/** @var MatchRepository @inject */
	public $matchRepository;

	/** @var Match[] */
	private $matches;

	public function actionDefault()
	{
		$this->matches = $this->matchRepository->getFeatured();
	}


	public function renderDefault()
	{
		$this->template->matches = $this->matches;
	}
}
