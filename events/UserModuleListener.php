<?php

namespace Wame\LocationModule\Events;

use Nette\Object;
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
		$userRepository->onEdit[] = [$this, 'onEdit'];
		$userRepository->onDelete[] = [$this, 'onDelete'];
	}

	
	public function onCreate($form, $values, $userEntity) 
	{
		return $this->addressRepository->create($userEntity, $values, null, true);
	}
	
	
	public function onEdit()
	{
		
	}
	
	
	public function onDelete()
	{
		
	}

}
