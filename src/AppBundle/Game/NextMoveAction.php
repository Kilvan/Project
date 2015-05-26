<?php

namespace AppBundle\Game;

class NextMoveAction extends Action {
    
    private $shift;
    
   function __construct($text, $shift) {
        parent::__construct($text);      
        $this->shift = $shift;
    }
    
    function DoAction(Player $player, Cube $cube, GameBoard $gameBoard)
    {
        $gameBoard->MovePawn($player->GetPawn(), $this->shift);
    }
}
