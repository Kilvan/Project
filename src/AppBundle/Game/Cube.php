<?php

namespace AppBundle\Game;

class Cube {
    
    private $result;
    
    function __construct()
    {
        $this->result = rand() % 6 + 1;
    }
    
    function Rand()
    {
        $this->result = rand() % 6 + 1;
    }
    
    function GetResult()
    {
        return $this->result;
    }
    
}
