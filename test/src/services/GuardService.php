<?php

class GuardService extends wash\Service
{
    /** @service="EntityService" */
    public $entityService;

    public function haveToken ($controller, $token)
    {
        return $token != false && $token != null;
    }

    public function token444 ($controller, $token)
    {
        return $token == 4444;
    }

    public function entityField ($controller, $token)
    {
        $entity = $this->entityService->getEntity();
        return $token == $entity->field;
    }

    public function notPass ()
    {
        return false;
    }

    public function pass ()
    {
        return true;
    }

    public function endsHere ($controller)
    {
        return $controller->string("Custom end auth validation method", wash\HTTP::FORBIDDEN);
    }

}