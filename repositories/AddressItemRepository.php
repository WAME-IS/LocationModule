<?php

namespace Wame\LocationModule\Repositories;

use Wame\Core\Registers\RepositoryRegister;
use Wame\Core\Registers\StatusTypeRegister;
use Wame\Core\Repositories\BaseRepository;
use Wame\LocationModule\Entities\AddressItemEntity;


class AddressItemRepository extends BaseRepository
{
    /** @var AddressRepository */
    private $addressRepository;

    /** @var RepositoryRegister */
    private $repositoryRegister;

    /** @var StatusTypeRegister */
    private $statusTypeRegister;


    public function __construct(
        AddressRepository $addressRepository,
        RepositoryRegister $repositoryRegister,
        StatusTypeRegister $statusTypeRegister
    ) {
        parent::__construct(AddressItemEntity::class);

        $this->addressRepository = $addressRepository;
        $this->repositoryRegister = $repositoryRegister;
        $this->statusTypeRegister = $statusTypeRegister;
    }


	/**
	 * Create address item
	 *
	 * @param AddressItemEntity $addressItemEntity
	 * @return AddressItemEntity
	 */
	public function create($addressItemEntity)
	{
		$this->entityManager->persist($addressItemEntity);

		return $addressItemEntity;
	}


	/**
	 * Update address item
	 *
	 * @param AddressItemEntity $addressItemEntity
	 * @return AddressItemEntity
	 */
	public function update($addressItemEntity)
	{
		return $addressItemEntity;
	}


    /**
     * Get main address
     * by type and valueId
     *
     * @param string $type
     * @param int $value
     *
     * @return AddressItemEntity|null
     */
	public function getMain($type, $value)
    {
        return $this->get(['type' => $type, 'valueId' => $value, 'address.main' => true]);
    }


    /**
     * Set main address
     *
     * @param int $id
     *
     * @return mixed
     */
	public function setMain($id)
    {
        $addressItemEntity = $this->get(['id' => $id]);
        $type = $addressItemEntity->getType();
        $value = $addressItemEntity->getValueId();
        $addressEntity = $addressItemEntity->getAddress();

        $entityName = $this->statusTypeRegister->getByName($type)->getEntityName();

        if (method_exists((new $entityName()), 'getAddress')) {
            $repository = $this->repositoryRegister->getByName($entityName);
            $entity = $repository->get(['id' => $value]);

            $entity->setAddress($addressEntity);
        }

        $items = $this->find(['type' => $type, 'valueId' => $value]);

        foreach ($items as $item) {
            $item->getAddress()->setMain(false);
        }

        $this->entityManager->flush();

        return $addressEntity->setMain(true);
    }


    /**
     * Set next address as main
     *
     * @param int $id
     */
    public function setNextAsMain($id)
    {
        $addressItemEntity = $this->get(['id' => $id]);
        $next = $this->get(['type' => $addressItemEntity->getType(), 'valueId' => $addressItemEntity->getValueId(), 'id !=' => $id]);

        if ($next) {
            $this->setMain($next->getId());
        } else {
            $entityName = $this->statusTypeRegister->getByName($type)->getEntityName();

            if (method_exists((new $entityName()), 'getAddress')) {
                $repository = $this->repositoryRegister->getByName($entityName);
                $entity = $repository->get(['id' => $value]);

                $entity->setAddress(null);
            }

            $addressItemEntity->setMain(false);
        }

        $this->entityManager->flush();
    }

}
