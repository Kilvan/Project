<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * GameBoard
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GameBoard
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
     * @ORM\OneToMany(targetEntity="Field", mappedBy="gameBoard", cascade={"persist", "remove"})
     */
    private $fields;

    function __toString() {
        return (string)$this->id;
    }
    
    function __construct()
    {
        $this->fields = new ArrayCollection();
        for( $i = 1; $i<50; $i++)
        {
            if( $i % 3 == 0 )
            {
                $field = new Field(new Action("xxx"), $i);
            } 
            else if ( $i % 3 == 1)
            {
                $field = new Field(new Action(" Tylko tekst"), $i); 
            }
            else
            {
                $field = new Field(new Action("xxx"), $i);
            }
            $this->fields[] = $field;
            $field->setGameBoard($this);
        }  
        $field = new Field(new Action("xxx"), $i);
        
        $this->fields[] = $field;
        $field->setGameBoard($this);
    }
    
    function GetAction(Pawn $pawn)
    {
        return $pawn->GetField()->GetAction();
    }
    
    function GetField($fieldNumber)
    {
        return $this->fields[$fieldNumber];
    }
    
    
    function GetLength()
    {
        return count($this->fields);
    }
    
    function MovePawn(Pawn $pawn, $shift)
    {
        $index = $pawn->GetFieldNumber() + $shift;                      
        if( $index >= $this->GetLength())
        {
            $pawn->SetPosition($this->GetField($this->GetLength() - 1   ));
        }
        else
        {
            $pawn->SetPosition($this->GetField($index));
        }
    }
    
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
     * Add fields
     *
     * @param \AppBundle\Entity\Field $fields
     * @return GameBoard
     */
    public function addField(\AppBundle\Entity\Field $fields)
    {
        $this->fields[] = $fields;

        return $this;
    }

    /**
     * Remove fields
     *
     * @param \AppBundle\Entity\Field $fields
     */
    public function removeField(\AppBundle\Entity\Field $fields)
    {
        $this->fields->removeElement($fields);
    }

    /**
     * Get fields
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFields()
    {
        return $this->fields;
    }
}
