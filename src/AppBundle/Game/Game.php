<?php

namespace AppBundle\Game;

class Game {
    
    private $gameNumber;
    private $gameBoard;
    private $cube;
    private $players;
    private $running;
    
    function __construct($players, $gameNumber) {
        $this->gameBoard = new GameBoard();
        $this->cube = new Cube();
        $this->gameNumber = $gameNumber;
        
        foreach($players as $player)
        {
            $this->players[] = new Player($player, new Pawn($this->gameBoard->GetField(0), $this->gameBoard));
        }
        
        $this->running = true;
    }
    
    function NextMove()
    {
        if($this->running)
        {
            foreach($this->players as $player)
            {
                $player->ThrowCube($this->cube);
                $this->gameBoard->MovePawn($player->GetPawn(), $player->CheckResult($this->cube));
                $action = $player->GetAction($player->GetPawn(), $this->gameBoard);

                if($action->DoAction($player, $this->cube, $this->gameBoard))
                {    
                    $this->running = false;
                    break;
                }
            }
        }
    }
    
    function IsRunning()
    {
        return $this->running;
    }
}
