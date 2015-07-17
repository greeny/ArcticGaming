<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\PublicModule;

use ArcticGaming\Forms\Form;
use ArcticGaming\Forms\Match\FilterForm;
use ArcticGaming\Model\Entities\Match;
use ArcticGaming\Model\Repositories\MatchRepository;
use Nette\InvalidArgumentException;
use Nette\Utils\Paginator;


class MatchesPresenter extends BasePublicPresenter
{
	/** @var MatchRepository @inject */
	public $matchRepository;

	/** @var FilterForm @inject */
	public $filterForm;

	/** @var Match[] */
	private $matches;

	/** @var string @persistent */
	public $game = NULL;

	/** @var string @persistent */
	public $opponent = NULL;

	/** @var string @persistent */
	public $tournament = NULL;

	/** @var string @persistent */
	public $result = NULL;


	public function actionDefault($page = 1)
	{
		$filter = $this->getFilterArray();
		$paginator = new Paginator;
		$paginator->page = $page;
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = $this->matchRepository->countByFilter($filter);
		if ($paginator->page !== $page) {
			$this->redirect('this', ['page' => $paginator->page]);
		}
		$this->matches = $this->matchRepository->getByFilter($filter, $paginator);
	}


	public function renderDefault()
	{
		$this->template->matches = $this->matches;
	}


	protected function createComponentFilterForm()
	{
		$form = $this->filterForm->create();
		try {
			$form->setDefaults($this->getFilterArray());
		} catch (InvalidArgumentException $e) {}
		$form->onSuccess[] = $this->filterFormSuccess;
		return $form;
	}


	public function filterFormSuccess(Form $form)
	{
		$values = $form->getValues();
		$this->redirect('this', [
			'game' => $values->game,
			'opponent' => $values->opponent,
			'tournament' => $values->tournament,
			'result' => $values->result,
		]);
	}


	private function getFilterArray()
	{
		return [
			'game' => $this->game,
			'opponent' => $this->opponent,
			'tournament' => $this->tournament,
			'result' => $this->result,
		];
	}
}
