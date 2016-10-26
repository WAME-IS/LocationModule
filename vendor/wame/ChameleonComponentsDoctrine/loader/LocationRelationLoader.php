<?php

namespace Wame\LocationModule\Vendor\Wame\ChameleonComponentsDoctrine\Loader;

use Nette\DI\Container;
use Wame\LocationModule\Vendor\Wame\ChameleonComponentsDoctrine\Registers\Types\FromCityRelation;
use Wame\LocationModule\Vendor\Wame\ChameleonComponentsDoctrine\Registers\Types\ToCityRelation;
use Wame\ChameleonComponentsDoctrine\Registers\RelationsRegister;
use Wame\Core\Registers\StatusTypeRegister;

class LocationRelationLoader
{
    /** @var Container */
    private $container;

    /** @var StatusTypeRegister */
    private $statusTypeRegister;

    
    public function __construct(Container $container, StatusTypeRegister $statusTypeRegister)
    {
        $this->container = $container;
        $this->statusTypeRegister = $statusTypeRegister;
    }

    
    public function initialize(RelationsRegister $relationsRegister)
    {
        foreach ($this->statusTypeRegister as $statusType) {
            $relationsRegister->add(new FromCityRelation($statusType->getAlias(), $statusType->getEntityName()));
            $relationsRegister->add(new ToCityRelation($statusType->getAlias(), $statusType->getEntityName()));
        }
    }
    
}
