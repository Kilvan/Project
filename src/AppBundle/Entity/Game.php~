<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Game
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="GameBoard", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="gameboard_id", referencedColumnName="id")
     */
    private $gameBoard;
    
    /**
     * @ORM\OneToOne(targetEntity="Player", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="currentPlayer_id", referencedColumnName="id")
     */
    private $currentPlayer;
  
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Player", mappedBy="game", cascade={"persist", "remove"})
     */    
    public $players;
    
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
     * Set GameBoard
     *
     * @param \AppBundle\Entity\GameBoard $gameBoard
     * @return Game
     */
    public function setGameBoard(\AppBundle\Entity\GameBoard $gameBoard = null)
    {
        $this->GameBoard = $gameBoard;

        return $this;
    }

    /**
     * Get GameBoard
     *
     * @return \AppBundle\Entity\GameBoard 
     */
    public function getGameBoard()
    {
        return $this->GameBoard;
    }

    /**
     * Add players
     *
     * @param \AppBundle\Entity\Player $players
     * @return Game
     */
    public function addPlayer($players)
    {
        if(empty($this->currentyPlayer))
        {
            $this->players[] = new Player($players, new Pawn($this->gameBoard->GetField(0), $this->gameBoard), $this);
            $this->currentPlayer = $this->players[0]; 
        }
        else
        {
           $this->players[] = new Player($players, new Pawn($this->gameBoard->GetField(0), $this->gameBoard), $this);
        }

        return $this;
    }

    /**
     * Remove players
     *
     * @param \AppBundle\Entity\Player $players
     */
    public function removePlayer(\AppBundle\Entity\Player $players)
    {
        $this->players->removeElement($players);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayers()
    {
        return $this->players;
    }
    
    private $gameNumber;
    private $cube;
    private $running;
    
    function __construct() {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gameBoard = new GameBoard();
        $this->cube = new Cube();
        
        $this->running = true;
    }
    
    function NextMove()
    {
        $this->currentPlayer->ThrowCube($this->cube);
        $this->gameBoard->MovePawn($this->currentPlayer->GetPawn(), $this->currentPlayer->CheckResult($this->cube));
        $action = $this->currentPlayer->GetAction($this->currentPlayer->GetPawn(), $this->gameBoard);
        $action->DoAction($this->currentPlayer, $this->cube, $this->gameBoard);
        $this->nextPlayer();
    }
    
    function IsRunning()
    {
        return $this->running;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Game
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set currentPlayer
     *
     * @param \AppBundle\Entity\Player $currentPlayer
     * @return Game
     */
    public function setCurrentPlayer(\AppBundle\Entity\Player $currentPlayer = null)
    {
        $this->currentPlayer = $currentPlayer;

        return $this;
    }

    /**
     * Get currentPlayer
     *
     * @return \AppBundle\Entity\Player 
     */
    public function getCurrentPlayer()
    {
        return $this->currentPlayer;
    }
    
    public function nextPlayer()
    {   
        $arraySize = count($this->players);
        for($i = 0; $i< $arraySize; $i++)
        {
            if($this->currentPlayer == $this->players[$i])
            {
                if($this->currentPlayer != $this->players[$arraySize-1])
                {
                    $this->currentPlayer = $this->players[$i+1];
                }
                else
                {
                    $this->currentPlayer = $this->players[0];
                }
                
            }
        }
    }
}
