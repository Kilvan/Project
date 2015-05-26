<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pawn
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Pawn
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __toString() {
        return (string)$this->id;
    }
    
     /**
     * @ORM\ManyToOne(targetEntity="Field", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="field_id", referencedColumnName="id")
     */
    private $field;
    private $gameboard;
    
    function __construct(Field $field, GameBoard $gameBoard)
    {
        $this->field = $field;
        $this->gameboard = $gameBoard;
    }
    
    function GetFieldNumber()
    {
        return $this->field->GetFieldNumber();
    }
    
    function SetPosition(Field $field)
    {
        $this->field = $field;
    }

    /**
     * Set field
     *
     * @param \AppBundle\Entity\Field $field
     * @return Pawn
     */
    public function setField(\AppBundle\Entity\Field $field = null)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return \AppBundle\Entity\Field 
     */
    public function getField()
    {
        return $this->field;
    }
}
