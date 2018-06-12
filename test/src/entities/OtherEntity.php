<?php

class OtherEntity 
{
    public $variable;
    public $property;
    public $field;

    public static function new () 
    {
        $entity = new self;
        $entity->variable = 'Other Var';
        $entity->property = 5;
        $entity->field = "Field";
        return $entity;
    }
    
}