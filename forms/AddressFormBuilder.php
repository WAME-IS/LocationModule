<?php

namespace Wame\LocationModule\Forms;

use Wame\Core\Registers\RepositoryRegister;
use Wame\Core\Registers\StatusTypeRegister;
use Wame\DynamicObject\Forms\BaseForm;
use Wame\DynamicObject\Forms\EntityFormBuilder;
use Wame\LocationModule\Entities\AddressItemEntity;
use Wame\LocationModule\Repositories\AddressItemRepository;


class AddressFormBuilder extends EntityFormBuilder
{
    /** @var AddressItemRepository */
    private $addressItemRepository;

    /** @var RepositoryRegister */
    private $repositoryRegister;

    /** @var StatusTypeRegister */
    private $statusTypeRegister;


    public function __construct(
        AddressItemRepository $addressItemRepository,
        RepositoryRegister $repositoryRegister,
        StatusTypeRegister $statusTypeRegister
    ) {
        parent::__construct();

        $this->addressItemRepository = $addressItemRepository;
        $this->repositoryRegister = $repositoryRegister;
        $this->statusTypeRegister = $statusTypeRegister;
    }


    protected function postUpdate(BaseForm $form, array $values)
    {
        $address = $form->getEntity();
        $id = $form->getPresenter()->getId();
        $type = $values['TypeContainer']['type'];

        $addressItemEntity = new AddressItemEntity();
        $addressItemEntity->setAddress($address);
        $addressItemEntity->setValueId($id);
        $addressItemEntity->setType($type);

        $this->addressItemRepository->create($addressItemEntity);

        $entityName = $this->statusTypeRegister->getByName($type)->getEntityName();

        if (method_exists((new $entityName()), 'getAddress')) {
            $repository = $this->repositoryRegister->getByName($entityName);
            $entity = $repository->get(['id' => $id]);

            if ($entity->getAddress() == null) {
                $address->setMain(true);
                $entity->setAddress($address);
            }
        }
    }

}
