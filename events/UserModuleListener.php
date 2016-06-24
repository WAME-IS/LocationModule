<?php

namespace Wame\LocationModule\Events;

use Nette\Object;
use Wame\LocationModule\Entities\AddressEntity;
use Wame\LocationModule\Repositories\AddressRepository;
use Wame\LocationModule\Repositories\StateRepository;
use Wame\UserModule\Repositories\UserRepository;


class UserModuleListener extends Object 
{
	/** @var AddressRepository */
	private $addressRepository;
	
	/** @var StateRepository */
	private $stateRepository;


	public function __construct(
		AddressRepository $addressRepository,
		UserRepository $userRepository
	) {
		$this->addressRepository = $addressRepository;
		
		$userRepository->onCreate[] = [$this, 'onCreate'];
		$userRepository->onUpdate[] = [$this, 'onUpdate'];
		$userRepository->onDelete[] = [$this, 'onDelete'];
	}


	public function onCreate($form, $values, $userEntity) 
	{
		if ($values['street'] || $values['houseNumber'] || $values['zipCode'] || $values['city']) {
			$stateEntity = $this->stateRepository->get(['id' => $values['state']]);

			$address = new AddressEntity;
			$address->setUser($userEntity);
			$address->setTitle($values['street'] . ' ' . $values['city']);
			$address->setStreet($values['street']);
			$address->setHouseNumber($values['houseNumber']);
			$address->setZipCode($values['zipCode']);
			$address->setCity($values['city']);
			$address->setState($stateEntity);
			$address->setMain(1);
			$address->setStatus(AddressRepository::STATUS_ACTIVE);
			
			$this->addressRepository->create($address);
		}
	}


	public function onUpdate($form, $values, $userEntity)
	{
		$address = $this->addressRepository->get(['user' => $userEntity->id]);
		$stateEntity = $this->stateRepository->get(['id' => $values['state']]);
		
		$address->setTitle($values['street'] . ' ' . $values['city']);
		$address->setStreet($values['street']);
		$address->setHouseNumber($values['houseNumber']);
		$address->setZipCode($values['zipCode']);
		$address->setCity($values['city']);
		$address->setState($stateEntity);
		
		$this->addressRepository->update($address);
	}


	public function onDelete($userId)
	{
		$this->addressRepository->delete(['user' => $userId]);
	}

}
