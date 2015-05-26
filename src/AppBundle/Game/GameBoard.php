<?php

namespace AppBundle\Game;

class GameBoard {
    
    private $fields;
    
    function __construct()
    {
        for( $i = 1; $i<50; $i++)
        {
            if( $i % 3 == 0 )
            {
                $this->fields[] = new Field(new NextMoveAction("Przesuniecie pionka o losowa wartosc ", rand()%3 - 1), $i); 
            } 
            else if ( $i % 3 == 1)
            {
                $this->fields[] = new Field(new Action(" Tylko tekst"), $i); 
            }
            else
            {
                $this->fields[] = new Field(new ReRollAction("ponowny rzut"), $i); 
            }
        }  
        $this->fields[] = new Field( new GameEndAction("KONIEC !"), 50);
    }
    
    function GetAction(Pawn $pawn)
    {
        return $pawn->GetField()->GetAction();
    }
    
    function GetField($fieldNumber)
    {
        return $this->fields[$fieldNumber];
    }
    
    function getFields()
    {
        return $this->fields;
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
}
