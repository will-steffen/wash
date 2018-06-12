<?php

use wash\Wash as Wash;

Wash::Import(
    'InnerEntity',
    'OtherEntity'
);

class Entity 
{
    public $property;
    public $field;
    public $innerEntity;
    public $otherEntity;

    public static function new () 
    {
        $entity = new self;
        $entity->property = 'property';
        $entity->field = 'field';
        $entity->innerEntity = new InnerEntity();
        $entity->otherEntity = OtherEntity::new();
        return $entity;
    }
    
}