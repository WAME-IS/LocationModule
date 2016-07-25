<?php

namespace Wame\LocationModule\Repositories;

use h4kuna\Gettext\GettextSetup;
use Kdyby\Doctrine\EntityManager;
use Nette\DI\Container;
use Nette\Security\User;
use Wame\Core\Exception\RepositoryException;
use Wame\LanguageModule\Repositories\TranslatableRepository;
use Wame\LocationModule\Entities\RegionEntity;
use Wame\LocationModule\Entities\RegionLangEntity;


class RegionRepository extends TranslatableRepository
{
    const STATUS_REMOVE = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    
    public function __construct(
        Container $container, EntityManager $entityManager, GettextSetup $translator, User $user
    ) {
        parent::__construct($container, $entityManager, $translator, $user, RegionEntity::class);
    }

    
    /**
     * Create region
     * 
     * @param RegionEntity $regionEntity
     * @return RegionEntity
     * @throws RepositoryException
     */
    public function create($regionEntity)
    {
        $create = $this->entityManager->persist($regionEntity);

        $this->entityManager->persist($regionEntity->langs);
        
        $this->entityManager->flush();

        if (!$create) {
            throw new RepositoryException(_('Region could not be created.'));
        }

        return $regionEntity;
    }

    
    /**
     * Update region
     * 
     * @param RegionEntity $regionEntity
     * @return RegionEntity
     */
    public function update($regionEntity)
    {
        return $regionEntity;
    }

    
    /**
     * Change state status
     * 
     * @param array $criteria
     * @param int $status
     */
    public function changeStatus($criteria = [], $status = self::STATUS_REMOVE)
    {
        $entity = $this->get($criteria);
        $entity->status = $status;
    }

    
    public function createIfNotExists($criteria = [])
    {
        $regionEntity = $this->get($criteria);
        
        if ($regionEntity) {
            return $regionEntity;
        }
        
        $newRegionEntity = new RegionEntity();
        $newRegionEntity->setEditDate(\Wame\Utils\Date::toDateTime('now'));
        $newRegionEntity->setEditUser($this->user->getEntity());
        $newRegionEntity->setStatus(self::STATUS_ENABLED);
        $newRegionEntity->setToken(time());
        
        if (isset($criteria['state'])) {
            $newRegionEntity->setState($criteria['state']);
        }

        $newRegionLangEntity = new RegionLangEntity();
        $newRegionLangEntity->setLang($this->lang);
        $newRegionLangEntity->setRegion($newRegionEntity);
        $newRegionLangEntity->setTitle($criteria['title']);
        $newRegionLangEntity->setSlug(\Nette\Utils\Strings::webalize($criteria['title']));
        
        $newRegionEntity->addLang($this->lang, $newRegionLangEntity);
        
        return $this->create($newRegionEntity);
    }

}