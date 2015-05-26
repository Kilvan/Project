<?php

namespace AppBundle\Entity;

class Person {
    private $name;
    
    public function __construct() {
        
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
