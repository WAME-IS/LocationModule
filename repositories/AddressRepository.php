<?php

namespace Wame\LocationModule\Repositories;

use Wame\LocationModule\Entities\AddressEntity;

class AddressRepository extends \Wame\Core\Repositories\BaseRepository
{
	const STATUS_REMOVE = 0;
	const STATUS_ACTIVE = 1;
	
	
	public function __construct(\Nette\DI\Container $container, \Kdyby\Doctrine\EntityManager $entityManager, \h4kuna\Gettext\GettextSetup $translator, \Nette\Security\User $user, $entityName = null) {
		parent::__construct($container, $entityManager, $translator, $user, AddressEntity::class);
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
	
}