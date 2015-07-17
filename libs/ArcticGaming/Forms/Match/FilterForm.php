<?php
/**
 * @author Tomáš Blatný
 */

namespace ArcticGaming\Forms\Match;

use ArcticGaming\Forms\BaseForm;
use ArcticGaming\Forms\Form;
use ArcticGaming\Model\Repositories\GameRepository;
use ArcticGaming\Model\Repositories\OpponentRepository;
use ArcticGaming\Model\Repositories\TournamentRepository;
use Nette\Localization\ITranslator;


class FilterForm extends BaseForm
{

	const WON_GAMES = 'won';
	const LOST_GAMES = 'lost';
	const DRAW_GAMES = 'draw';
	const WITHOUT_RESULT_GAMES = 'no';

	/** @var GameRepository */
	private $gameRepository;

	/** @var TournamentRepository */
	private $tournamentRepository;

	/** @var OpponentRepository */
	private $opponentRepository;


	public function __construct(GameRepository $gameRepository, TournamentRepository $tournamentRepository, OpponentRepository $opponentRepository, ITranslator $translator)
	{
		$this->gameRepository = $gameRepository;
		$this->tournamentRepository = $tournamentRepository;
		$this->opponentRepository = $opponentRepository;
		$this->translator = $translator;
	}

	public function initialize(Form $form)
	{
		$form->setTranslator(NULL);
		$form->addSelect('game', $this->_('forms.match.fields.game'), $this->gameRepository->getPairs())
			->setPrompt($this->_('forms.match.labels.allGames'));

		$form->addSelect('opponent', $this->_('forms.match.fields.opponent'), $this->opponentRepository->getPairs())
			->setPrompt($this->_('forms.match.labels.allOpponents'));

		$form->addSelect('tournament', $this->_('forms.match.fields.tournament'), $this->tournamentRepository->getPairs())
			->setPrompt($this->_('forms.match.labels.allTournaments'));

		$form->addSelect('result', $this->_('forms.match.fields.result'), [
			self::WON_GAMES => $this->_('forms.match.labels.wonGames'),
			self::LOST_GAMES => $this->_('forms.match.labels.lostGames'),
			self::DRAW_GAMES => $this->_('forms.match.labels.drawGames'),
			self::WITHOUT_RESULT_GAMES => $this->_('forms.match.labels.withoutResultGames'),
		])
			->setPrompt($this->_('forms.match.labels.allResults'));

		$form->addSubmit('filter', $this->_('forms.match.fields.submit'));
	}


	public function validateData(Form $form)
	{

	}


	public function formSuccess(Form $form)
	{

	}


	private function _($text)
	{
		return $this->translator->translate($text);
	}
}
