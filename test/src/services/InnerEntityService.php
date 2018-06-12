<?php

class InnerEntityService extends wash\Service
{
    /** @service="EntityService" */
    public $entityService;

    public function getEntity ()
    {
        return $this->entityService->getEntity();
    }

    public function getInnerEntity ()
    {
        return new InnerEntity();
    }
    
}