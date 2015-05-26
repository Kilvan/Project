<?php

namespace AppBundle\Game;

class Field {
    
    private $fieldNumber;
    private $action;
    
    function __construct(Action $action, $fieldNumber)
    {
        $this->fieldNumber = $fieldNumber;
        $this->action = $action;
    }
    
    function GetFieldNumber()
    {
        return $this->fieldNumber;
    }
    
    function GetAction()
    {
        return $this->action;
    }
}
