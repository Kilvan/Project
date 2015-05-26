<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Player
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
     * @ORM\OneToOne(targetEntity="Pawn", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="pawn_id", referencedColumnName="id")
     */
    private $pawn;
    
    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="Player")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id") 
     */
    private $game;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    
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
     * Set name
     *
     * @param string $name
     * @return Player
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
    
    function __construct($name, $pawn, $game)
    {
        $this->name = $name;
        $this->pawn = $pawn;
        $this->game = $game;
    }
    
    function ThrowCube(Cube $cube)
    {
        $cube->Rand();
    }
    
    function CheckResult(Cube $cube)
    {
        return $cube->GetResult();
    }
    
    function GetPawnField(Pawn $pawn)
    {
        return $pawn->GetFieldNumber();
    }
    
    function GetAction(Pawn $pawn, GameBoard $gameBoard)
    {
        return $gameBoard->GetAction($pawn);
    }

    /**
     * Set game
     *
     * @param \AppBundle\Entity\GameBoard $game
     * @return Player
     */
    public function setGame(\AppBundle\Entity\GameBoard $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \AppBundle\Entity\GameBoard 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set pawn
     *
     * @param \AppBundle\Entity\Pawn $pawn
     * @return Player
     */
    public function setPawn(\AppBundle\Entity\Pawn $pawn = null)
    {
        $this->pawn = $pawn;

        return $this;
    }

    /**
     * Get pawn
     *
     * @return \AppBundle\Entity\Pawn 
     */
    public function getPawn()
    {
        return $this->pawn;
    }
}
