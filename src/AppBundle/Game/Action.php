<?php

namespace AppBundle\Game;

class Action {
    
    private $text;
    
    function __construct($text)
    {
        $this->text = $text;
    }
    
    
    function GetActionText()
    {
        return $this->text;
    }
    
    function DoAction(Player $player, Cube $cube, GameBoard $gameBoard)
    {
        
    }
}
