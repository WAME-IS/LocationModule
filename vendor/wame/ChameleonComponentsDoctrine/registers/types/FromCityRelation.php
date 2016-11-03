<?php

namespace Wame\LocationModule\Vendor\Wame\ChameleonComponentsDoctrine\Registers\Types;

use Kdyby\Doctrine\QueryBuilder;
use Wame\ChameleonComponents\Definition\DataDefinitionTarget;
use Wame\ChameleonComponents\Definition\DataSpace;
use Wame\ChameleonComponentsDoctrine\Registers\Types\IRelation;
use Wame\Core\Entities\BaseEntity;
use Wame\LocationModule\Entities\CityEntity;
use Wame\SiteModule\Entities\SiteItemEntity;
use Wame\SiteModule\Entities\SiteEntity;
use Wame\UserModule\Entities\CompanyEntity;
use Wame\LocationModule\Entities\AddressEntity;
use Doctrine\ORM\Query\Expr\Join;

class FromCityRelation implements IRelation
{
    /** @var string */
    private $type;

    /** @var string */
    private $className;

    
    public function __construct($type, $className)
    {
        $this->type = $type;
        $this->className = $className;
    }

    /**
     * @return DataDefinitionTarget
     */
    public function getFrom()
    {
        return new DataDefinitionTarget(CityEntity::class, true);
    }

    /**
     * @return DataDefinitionTarget
     */
    public function getTo()
    {
        return new DataDefinitionTarget($this->className, true);
    }

    /**
     * @param QueryBuilder $qb
     * @param DataSpace $from
     * @param DataSpace $to
     * @param string $relationAlias
     */
    public function process(QueryBuilder $qb, $from, $to, $relationAlias)
    {
        $item = $to->getControl()->getStatus()->get($this->className);
        $mainAlias = $qb->getAllAliases()[0];

        $qb->innerJoin(TagItemEntity::class, $relationAlias);
        $qb->andWhere($mainAlias . ' = ' . $relationAlias . '.tag');
//        $qb->andWhere($mainAlias . '.type = :type')->setParameter('type', $this->type);
        $qb->andWhere($relationAlias . '.item_id = :item')->setParameter('item', $item->getId());

        /*
          if ($from->getDataDefinition()->getQueryType() == 'select') {
          $qb->select([$mainAlias, $relationAlias]);
          } else {

          } */
    }

    /**
     * @param BaseEntity[] $result
     * @param DataSpace $from
     * @param DataSpace $to
     */
    public function postProcess(&$result, $from, $to)
    {
        
    }

    /**
     * @param mixed $hint
     * @return boolean
     */
    public function matchHint($hint)
    {
        return false;
    }
}
