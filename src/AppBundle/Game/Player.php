<?php

require_once 'Cube.php';
require_once 'Pawn.php';
require_once 'Action.php';
require_once 'GameBoard.php';

class Player {
    
    private $name;
    private $pawn;
    
    function __construct($name, $pawn)
    {
        $this->name = $name;
        $this->pawn = $pawn;
    }
    
    function ThrowCube(Cube $cube)
    {
        $cube->Rand();
    }
    
    function CheckResult(Cube $cube)
    {
        return $cube->GetResult();
    }
    
    function GetPawnField(Pawn $pawn)
    {
        return $pawn->GetFieldNumber();
    }
    
    function GetAction(Pawn $pawn, GameBoard $gameBoard)
    {
        return $gameBoard->GetAction($pawn);
    }
    
    function GetName()
    {
        return $this->name;
    }
    
    function GetPawn()
    {
        return $this->pawn;
    }
}
