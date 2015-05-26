<?php

namespace AppBundle\Game;

class ReRollAction extends Action{
    
    function __construct($text) {
        parent::__construct($text);
        
    }
    
    function DoAction(Player $player, Cube $cube, GameBoard $gameBoard)
    {
        $player->ThrowCube($cube);
        $gameBoard->MovePawn($player->GetPawn(), $cube->GetResult());
    }
}
