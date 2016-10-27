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

class ToCityRelation implements IRelation
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
        return new DataDefinitionTarget($this->className, true);
    }

    /**
     * @return DataDefinitionTarget
     */
    public function getTo()
    {
        return new DataDefinitionTarget(CityEntity::class, false);
    }

    /**
     * @param QueryBuilder $qb
     * @param DataSpace $from
     * @param DataSpace $to
     * @param string $relationAlias
     */
    public function process(QueryBuilder $qb, $from, $to, $relationAlias)
    {
        // TODO: ziskavat z $to namiesto $from keby nevratilo NULL
        $status = $from->getControl()->getStatus();
        $latitude = $status->get('latitude');
        $longitude = $status->get('longitude');
        $radius = $status->get('radius');
        
//        $city = $to ? $to->getControl()->getStatus()->get($this->className) : null;
        $mainAlias = $qb->getAllAliases()[0];
        
        $qb->innerJoin(SiteItemEntity::class, 'siteitem', Join::WITH, "siteitem.value = $mainAlias.id");
        $qb->innerJoin(SiteEntity::class, 'site', Join::WITH, "siteitem.site = site.id");
        $qb->innerJoin(CompanyEntity::class, 'company', Join::WITH, "site.company = company.id");
        $qb->innerJoin(AddressEntity::class, 'address', Join::WITH, "company.address = address.id");
        $qb->innerJoin(CityEntity::class, $relationAlias, Join::WITH, "address.city = $relationAlias.id");

        $qb->andWhere("(6371 * acos( cos( radians($latitude) ) * cos( radians( $relationAlias.latitude ) ) * cos( radians( $relationAlias.longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( $relationAlias.latitude ) ) ) ) < :radius");
        $qb->setParameter('radius', $radius);
        
        $qb->andWhere('siteitem.type = :type')->setParameter('type', $this->type);
        
//        if ($city) {
//            $qb->andWhere($relationAlias . '.city = :city')->setParameter('city', $city);
//        }
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
