<?php

namespace Wame\LocationModule\Repositories;

use h4kuna\Gettext\GettextSetup;
use Kdyby\Doctrine\EntityManager;
use Nette\DI\Container;
use Nette\Security\User;
use Wame\Core\Exception\RepositoryException;
use Wame\Core\Repositories\TranslatableRepository;
use Wame\LocationModule\Entities\CityEntity;
use Wame\LocationModule\Entities\CityLangEntity;


class CityRepository extends TranslatableRepository
{
    const STATUS_REMOVE = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    
    public function __construct(
        Container $container, 
        EntityManager $entityManager, 
        GettextSetup $translator, 
        User $user
    ) {
        parent::__construct($container, $entityManager, $translator, $user, CityEntity::class);
    }

    
    /**
     * Create city
     * 
     * @param CityEntity $cityEntity
     * @return CityEntity
     * @throws RepositoryException
     */
    public function create($cityEntity)
    {
        $create = $this->entityManager->persist($cityEntity);

        $this->entityManager->persist($cityEntity->langs);

        if (!$create) {
            throw new RepositoryException(_('City could not be created.'));
        }

        return $cityEntity;
    }

    
    /**
     * Update city
     * 
     * @param CityEntity $cityEntity
     * @return CityEntity
     */
    public function update($cityEntity)
    {
        return $cityEntity;
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
        $cityEntity = $this->get($criteria);
        
        if ($cityEntity) {
            return $cityEntity;
        }
        
        $newCityEntity = new CityEntity();
        $newCityEntity->setImportId($criteria['importId']);
        $newCityEntity->setLatitude($criteria['latitude']);
        $newCityEntity->setLongitude($criteria['longitude']);
        $newCityEntity->setEditDate(\Wame\Utils\Date::toDateTime('now'));
        $newCityEntity->setEditUser($this->user->getEntity());
        $newCityEntity->setStatus(self::STATUS_ENABLED);
        $newCityEntity->setToken(time());
        
        if (isset($criteria['zipCode'])) {
            $newCityEntity->setZipCode($criteria['zipCode']);
        }
        
        if (isset($criteria['region'])) {
            $newCityEntity->setRegion($criteria['region']);
        }
        
        if (isset($criteria['state'])) {
            $newCityEntity->setState($criteria['state']);
        }

        $newCityLangEntity = new CityLangEntity();
        $newCityLangEntity->setLang($this->lang);
        $newCityLangEntity->setCity($newCityEntity);
        $newCityLangEntity->setTitle($criteria['title']);
        $newCityLangEntity->setSlug(\Nette\Utils\Strings::webalize($criteria['title']));
        
        $newCityEntity->addLang($this->lang, $newCityLangEntity);

        return $this->create($newCityEntity);
    }

}