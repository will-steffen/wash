<?php

class InnerEntity 
{
    public $variable = 'Inner Var';
    public $property = 10;
    public $field;

    public function __construct () 
    {
        $this->field = "Field";
    }
    
}