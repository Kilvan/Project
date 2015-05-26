<?php

namespace AppBundle\Game;

class Pawn {
    
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
    
    function GetField()
    {
        return $this->field;
    }
    
    function SetPosition(Field $field)
    {
        $this->field = $field;
    }
}
