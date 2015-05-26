<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Field
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Field
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
     * @var integer
     *
     * @ORM\Column(name="fieldNumber", type="integer")
     */
    private $fieldNumber;
    
    /**
     * @ORM\OneToOne(targetEntity="Action", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="action_id", referencedColumnName="id")
     */
    private $action;
    
    /**
     * @ORM\ManyToOne(targetEntity="GameBoard", inversedBy="Field")
     * @ORM\JoinColumn(name="gameboard_id", referencedColumnName="id")
     */
    private $gameBoard;

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
     * Set fieldNumber
     *
     * @param integer $fieldNumber
     * @return Field
     */
    public function setFieldNumber($fieldNumber)
    {
        $this->fieldNumber = $fieldNumber;

        return $this;
    }

    /**
     * Get fieldNumber
     *
     * @return integer 
     */
    public function getFieldNumber()
    {
        return $this->fieldNumber;
    }

    /**
     * Set gameBoard
     *
     * @param \AppBundle\Entity\GameBoard $gameBoard
     * @return Field
     */
    public function setGameBoard(\AppBundle\Entity\GameBoard $gameBoard = null)
    {
        $this->gameBoard = $gameBoard;

        return $this;
    }

    /**
     * Get gameBoard
     *
     * @return \AppBundle\Entity\GameBoard 
     */
    public function getGameBoard()
    {
        return $this->gameBoard;
    }
    
    function __construct(Action $action, $fieldNumber)
    {
        $this->fieldNumber = $fieldNumber;
        $this->action = $action;
    }

    /**
     * Set action
     *
     * @param \AppBundle\Entity\Action $action
     * @return Field
     */
    public function setAction(\AppBundle\Entity\Action $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return \AppBundle\Entity\Action 
     */
    public function getAction()
    {
        return $this->action;
    }
}
