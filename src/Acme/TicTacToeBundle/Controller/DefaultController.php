<?php

namespace Acme\TicTacToeBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Acme\TicTacToeBundle\Tools\TicTacToe;
use Acme\TicTacToeBundle\Tools\Game;
use Acme\TicTacToeBundle\Entity\Player;
use Acme\TicTacToeBundle\Entity\GameList;


class DefaultController extends Controller
{
	/**
	 * Default action ( registration of user)
	 *
	 * @Route("/")
	 * @Template()
	 * @return array
	 */
	public function indexAction(Request $request)
	{
		// create a $player object and bind to the resgistration form
		$player = new Player();

		$form = $this->createFormBuilder($player)
		->add('userName', 'text')
		->add('firstName', 'text')
		->add('lastName', 'text')
		->getForm();

		// check for constraints and errors
		if ($request->isMethod('POST')) {
			
			$form->bind($request);
				
			if ($form->isValid()) {

				// get the form data and save to database
				$player = $form->getData();

				$em = $this->getDoctrine()->getManager();
				$em->persist($player);
				$em->flush();

				// redirect the user to the game board
				return $this->redirect("/game/" . $player->getUserName());
			}
		}

		return array('form' => $form->createView());
	}


	/**
	 * Game action ( set up a board game )
	 *
	 * @Route("/game/{name}")
	 * @Template()
	 * @param string $name
	 */
	public function gameAction($name)
	{

		return array('name'=>$name);
	}

	/**
	 * Play Action ( get the player bet positions and perform calcuation on winner)
	 *
	 * @Route("/play")
	 * @param Request $request
	 * @return JsonResponse
	 *
	 */
	public function playAction(Request $request)
	{

		$config = array(
				'player'	=>	Game::PLAYER,
				'move'		=>	array($request->get('pos1'),$request->get('pos2')),
		);

		//if we starting new game we don't realy have to send game board
		if ($request->get('gameBoard')){
			$config['gameBoard'] = $request->get('gameBoard');
		}
		$ticTacToe = new TicTacToe($config);

		return new Response($ticTacToe);

	}

	/**
	 * recordWinner action (log the game session to database after each game end)
	 * @Route("/recordWinner")
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function recordWinnerAction(Request $request)
	{

		
		// get the POST request parameters
		$winner = $request->get('winner');
		$player1 = $request->get('player1');
		$player2 = $request->get('player2');
		$gameName = $request->get('player1') . " vs " . $request->get('player2');
		
		// create a new  $gameList object to store the result
		$gameList = new GameList();

		$gameList->setPlayer1($player1);
		$gameList->setGameName($gameName);
		$gameList->setPlayer2($player2);
		$gameList->setWinner($winner);
		$gameList->setTime(new \DateTime());

		$em = $this->getDoctrine()->getManager();
		$em->persist($gameList);
		$em->flush();

		return new JsonResponse(array('success' => true));


	}

}
