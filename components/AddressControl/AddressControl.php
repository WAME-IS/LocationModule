<?php

namespace Wame\LocationModule\Components;

use Wame\Core\Components\BaseControl;
use Wame\LocationModule\Entities\AddressEntity;
use Wame\LocationModule\Repositories\AddressRepository;


interface IAddressControlFactory
{
	/** @return AddressControl */
	public function create();
}


class AddressControl extends BaseControl
{
    /** @var AddressRepository */
    private $addressRepository;


    public function __construct(
        \Nette\DI\Container $container,
        AddressRepository $addressRepository
    ) {
        parent::__construct($container);

        $this->addressRepository = $addressRepository;
    }


	public function render($addressEntity = null)
	{
        if (!$addressEntity) {
            $addressEntity = $this->getStatus()->get(AddressEntity::class);
        }

        if (!$addressEntity) {
            $addressEntity = $this->getAddressEntity();
        }

        if ($addressEntity) {
            $this->getStatus()->set(AddressEntity::class, $addressEntity);
        }

		$this->template->address = $addressEntity;
	}


    private function getAddressEntity()
    {
        $statusType = $this->getComponentParameter('statusType');

        if ($statusType) {
            $status = $this->statusTypeRegister->getByName($statusType);
            $entityName = $status->getEntityName();
            $entity = $this->getStatus()->get($entityName);

            return $this->addressRepository->getByEntity($entity, $statusType);
        }

        return null;
    }

}
