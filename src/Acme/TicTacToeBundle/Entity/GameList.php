<?php
namespace Acme\TicTacToeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="game_list")
 */
class GameList
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\Column(name="gameName",type="string", length=100)
	 */
	protected $gameName;
	
	/**
	 * @ORM\Column(name="winner",type="string", length=100)
	 */
	protected $winner;
	
	/**
	 * @ORM\Column(name="player1",type="string", length=100)
	 */
	protected $player1;
	
	/**
	 * @ORM\Column(name="player2",type="string", length=100)
	 */
	protected $player2;
	
	/**
	 * @ORM\Column(name="time",type="datetime")
	 */
	protected $time;
	
	
	
	
	

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set winner
     *
     * @param string $winner
     * @return GameList
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return string 
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set player1
     *
     * @param string $player1
     * @return GameList
     */
    public function setPlayer1($player1)
    {
        $this->player1 = $player1;

        return $this;
    }

    /**
     * Get player1
     *
     * @return string 
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * Set player2
     *
     * @param string $player2
     * @return GameList
     */
    public function setPlayer2($player2)
    {
        $this->player2 = $player2;

        return $this;
    }

    /**
     * Get player2
     *
     * @return string 
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return GameList
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set gameName
     *
     * @param string $gameName
     * @return GameList
     */
    public function setGameName($gameName)
    {
        $this->gameName = $gameName;

        return $this;
    }

    /**
     * Get gameName
     *
     * @return string 
     */
    public function getGameName()
    {
        return $this->gameName;
    }
}
