<?php

namespace AppBundle\Game;

class GameEndAction extends Action {
    
    function __construct($text) {
        parent::__construct($text);
    }
    
    function DoAction(Player $player, Cube $cube, GameBoard $gameBoard)
    {
        return true;
    }
}
