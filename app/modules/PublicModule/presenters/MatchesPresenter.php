<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\PublicModule;

use ArcticGaming\Model\Entities\Match;
use ArcticGaming\Model\Repositories\MatchRepository;
use Nette\Utils\Paginator;


class MatchesPresenter extends BasePublicPresenter
{
	/** @var MatchRepository @inject */
	public $matchRepository;

	/** @var Match[] */
	private $matches;


	public function actionDefault($page = 1)
	{
		$paginator = new Paginator;
		$paginator->page = $page;
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = $this->matchRepository->countAll();
		if ($paginator->page !== $page) {
			$this->redirect('this', ['page' => $paginator->page]);
		}
		$this->matches = $this->matchRepository->getByPaginator($paginator);
	}


	public function renderDefault()
	{
		$this->template->matches = $this->matches;
	}
}
