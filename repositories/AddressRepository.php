<?php

namespace Wame\LocationModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\LocationModule\Entities\AddressEntity;

class AddressRepository extends BaseRepository
{
	const STATUS_REMOVE = 0;
	const STATUS_ACTIVE = 1;
	
	/** @var CityRepository */
    private $cityRepository;
    
	/** @var RegionRepository */
    private $regionRepository;
    
	/** @var StateRepository */
    private $stateRepository;
    

    public function __construct(
        CityRepository $cityRepository,
        RegionRepository $regionRepository,
        StateRepository $stateRepository
    ) {
		parent::__construct(AddressEntity::class);

        $this->cityRepository = $cityRepository;
        $this->regionRepository = $regionRepository;
        $this->stateRepository = $stateRepository;
    }
    
	
	/**
	 * Create address
	 * 
	 * @param AddressEntity $address
	 * @return AddressEntity
	 */
	public function create($address)
	{
		$this->entityManager->persist($address);
        
        $this->entityManager->flush();
		
		return $address;
	}
	
	
	/**
	 * Update address
	 * 
	 * @param AddressEntity $address
	 * @return AddressEntity
	 */
	public function update($address)
	{
		return $address;
	}
	
	
	/**
	 * Delete address by criteria
	 * 
	 * @param array $criteria
	 * @param int $status
	 */
	public function delete($criteria = [], $status = self::STATUS_REMOVE)
	{
		$address = $this->findOneBy($criteria);
		$address->status = $status;
	}
    
	
	/**
	 * Fill
	 * 
	 * @param array $values		values
	 * @return AddressEntity	address entity
	 */
	public function fill($values)
	{
		$addressEntity = new AddressEntity();
		$addressEntity->setUser($this->user->getEntity());
		$addressEntity->setStreet($values['street']);
		$addressEntity->setHouseNumber($values['houseNumber']);
		$addressEntity->setCity($values['city']);
		
		return $this->create($addressEntity);
	}
    
    
    /**
     * Create address from Google map API
     * 
     * @param array $address
     * @return AddressEntity
     */
    public function createAddressFromGoogleMapApi($address)
    {
        $addressEntity = new AddressEntity();
		$addressEntity->setUser($this->user->getEntity());
		$addressEntity->setStatus(self::STATUS_ACTIVE);
        
        if (isset($address['route'])) {
            $addressEntity->setStreet($address['route']);
        }
        
        if (isset($address['street_number'])) {
            $addressEntity->setHouseNumber($address['street_number']);
        }
        
        if (isset($address['country'])) {
            $stateEntity = $this->stateRepository->get(['code' => \Nette\Utils\Strings::lower($address['country']), 'status' => StateRepository::STATUS_ENABLED]);

            if (!$stateEntity) {
                throw new Exception(_('This state is not supported.'));
            }

            $addressEntity->setState($stateEntity);
        }
        
        if (isset($address['administrative_area_level_1'])) {
            $criteria = ['title' => $address['administrative_area_level_1']];
            
            if (isset($stateEntity)) {
                $criteria['state'] = $stateEntity;
            }
            
            $regionEntity = $this->regionRepository->createIfNotExists($criteria);
        }
        
        if (isset($address['locality'])) {
            $title = $address['locality'];
            
            if (isset($address['sublocality_level_1']) && $address['sublocality_level_1'] != $title) {
                $title .= ' - ' . $address['sublocality_level_1'];
            }
            
            $values = [
                'title' => $title, 
                'latitude' => $address['latitude'], 
                'longitude' => $address['longitude'],
                'importId' => $address['place_id']
            ];
            
            if (isset($address['postal_code'])) {
                $values['zipCode'] = $address['postal_code'];
            }
            
            if (isset($regionEntity)) {
                $values['region'] = $regionEntity;
            }
            
            if (isset($stateEntity)) {
                $values['state'] = $stateEntity;
            }
            
            $cityEntity = $this->cityRepository->createIfNotExists($values);
            
            $addressEntity->setCity($cityEntity);
        }
		
		return $this->create($addressEntity);
    }
	
}