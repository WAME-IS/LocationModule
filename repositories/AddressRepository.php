<?php

namespace Wame\LocationModule\Repositories;

use Wame\LocationModule\Entities\AddressEntity;

class AddressRepository extends \Wame\Core\Repositories\BaseRepository
{
	const STATUS_REMOVE = 0;
	const STATUS_ACTIVE = 1;
	
	public function create($userEntity, $values, $title = null, $main = false)
	{
		if (!$title) {
			$title = $values['street'] . ' ' . $values['city'];
		}
		
		$address = new AddressEntity;
		$address->user = $userEntity;
		$address->title = $title;
		$address->street = $values['street'];
		$address->houseNumber = $values['houseNumber'];
		$address->zipCode = $values['zipCode'];
		$address->city = $values['city'];
		$address->state = null;
		$address->main = $main;
		$address->status = self::STATUS_ACTIVE;
		
		$this->entityManager->persist($address);
		
		return $address;
	}
	
}