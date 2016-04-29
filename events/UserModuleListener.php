<?php

namespace Wame\LocationModule\Events;

use Nette\Object;
use Wame\LocationModule\Entities\AddressEntity;
use Wame\LocationModule\Repositories\AddressRepository;
use Wame\UserModule\Repositories\UserRepository;

class UserModuleListener extends Object 
{
	/** @var AddressRepository */
	private $addressRepository;
	
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
			$address = new AddressEntity;
			$address->user = $userEntity;
			$address->title = $values['street'] . ' ' . $values['city'];
			$address->street = $values['street'];
			$address->houseNumber = $values['houseNumber'];
			$address->zipCode = $values['zipCode'];
			$address->city = $values['city'];
			$address->state = null;
			$address->main = 1;
			$address->status = AddressRepository::STATUS_ACTIVE;
			
			$return = $this->addressRepository->create($address);
		} else {
			$return = $this;
		}
		
		return $return;
	}
	
	
	public function onUpdate($form, $values, $userEntity)
	{
		$address = $this->addressRepository->get(['user' => $userEntity->id]);
		
		$address->street = $values['street'];
		$address->houseNumber = $values['houseNumber'];
		$address->zipCode = $values['zipCode'];
		$address->city = $values['city'];
		
		return $this->addressRepository->update($address);
	}
	
	
	public function onDelete($userId)
	{
		$this->addressRepository->delete(['user' => $userId]);
	}

}
