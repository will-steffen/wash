<?php namespace wash;

class Wash 
{

    public function go () 
    {
        $c = new Controller();
        return $c->string('echo from Wash', HTTP::OK);
    }

}