<?php

namespace Wame\LocationModule\Repositories;

use Nette\Utils\Strings;
use Wame\Core\Exception\RepositoryException;
use Wame\LanguageModule\Repositories\TranslatableRepository;
use Wame\LocationModule\Entities\CityEntity;
use Wame\LocationModule\Entities\CityLangEntity;

class CityRepository extends TranslatableRepository
{
    const STATUS_REMOVE = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    
    public function __construct()
    {
        parent::__construct(CityEntity::class, CityLangEntity::class);
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
    
    
    /**
     * Create or update city
     * 
     * @param array $values
     * @return CityEntity
     */
    public function createIfNotExists($values = [])
    {
         \Tracy\Debugger::fireLog($values);
        $cityEntity = $this->get(['importId' => $values['place_id']]);
        
        if ($cityEntity) {
            return $this->updateCity($cityEntity, $values);
        } else {
            return $this->createCity($values);
        }
    }
    
    /**
     * Create city
     * 
     * @param array $values
     * @return CityEntity
     */
    public function createCity($values)
    {
        $cityEntity = new CityEntity();
        $cityEntity->setImportId($values['place_id']);
        $cityEntity->setEditDate(\Wame\Utils\Date::toDateTime('now'));
        $cityEntity->setEditUser($this->user->getEntity());
        $cityEntity->setStatus(self::STATUS_ENABLED);
        $cityEntity->setToken(time());
        
        if (isset($values['latitude'])) {
            $cityEntity->setLatitude($values['latitude']);
        }
        
        if (isset($values['longitude'])) {
            $cityEntity->setLongitude($values['longitude']);
        }
        
        if (isset($values['zipCode'])) {
            $cityEntity->setZipCode($values['zipCode']);
        }
        
        if (isset($values['region'])) {
            $cityEntity->setRegion($values['region']);
        }
        
        if (isset($values['state'])) {
            $cityEntity->setState($values['state']);
        }

        $cityLangEntity = new CityLangEntity();
        $cityLangEntity->setLang($this->lang);
        $cityLangEntity->setCity($cityEntity);
        $cityLangEntity->setTitle($values['title']);
        $cityLangEntity->setSlug(Strings::webalize($values['title']));
        
        $cityEntity->addLang($this->lang, $cityLangEntity);

        return $this->create($cityEntity);
    }
    
    
    /**
     * Update city
     * 
     * @param CityEntity $cityEntity
     * @param array $values
     * @return CityEntity
     */
    public function updateCity($cityEntity, $values)
    {
        if (isset($values['latitude'])) {
            $cityEntity->setLatitude($values['latitude']);
        }

        if (isset($values['longitude'])) {
            $cityEntity->setLongitude($values['longitude']);
        }

        if (isset($values['zipCode'])) {
            $cityEntity->setZipCode($values['zipCode']);
        }
        
        $cityEntity->setEditDate(\Wame\Utils\Date::toDateTime('now'));     
        $cityEntity->setEditUser($this->user->getEntity());
        $cityEntity->langs[$this->lang]->setTitle(isset($values['title']) ? $values['title'] : '');
        $cityEntity->langs[$this->lang]->setSlug(Strings::webalize(isset($values['title']) ? $values['title'] : ''));
        
        return $this->update($cityEntity);
    }

}