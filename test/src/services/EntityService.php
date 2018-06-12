<?php

wash\Wash::Import('custom-folder/CustomFile');

class EntityService extends wash\Service
{
    /** @service="InnerEntityService" */
    public $innerEntityService;

    public function getEntity ()
    {
        return Entity::new();
    }

    public function getInnerEntity ()
    {
        return $this->innerEntityService->getInnerEntity();
    }

    public function getUtil ()
    {
        return SomethingUtil::Useful();
    }

}
