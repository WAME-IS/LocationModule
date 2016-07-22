<?php

namespace Wame\LocationModule\Repositories;

use h4kuna\Gettext\GettextSetup;
use Kdyby\Doctrine\EntityManager;
use Nette\DI\Container;
use Nette\Security\User;
use Wame\Core\Exception\RepositoryException;
use Wame\Core\Repositories\TranslatableRepository;
use Wame\LocationModule\Entities\StateEntity;

class StateRepository extends TranslatableRepository
{

    const STATUS_REMOVE = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    public function __construct(
    Container $container, EntityManager $entityManager, GettextSetup $translator, User $user
    )
    {
        parent::__construct($container, $entityManager, $translator, $user, StateEntity::class);
    }

    /**
     * Create state
     * 
     * @param StateEntity $stateEntity
     * @return StateEntity
     * @throws RepositoryException
     */
    public function create($stateEntity)
    {
        $this->entityManager->persist($stateEntity);

        $this->entityManager->persist($stateEntity->langs);

        return $stateEntity;
    }

    /**
     * Update state
     * 
     * @param StateEntity $stateEntity
     * @return StateEntity
     */
    public function update($stateEntity)
    {
        return $stateEntity;
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
     * Return list of states in actual language
     * 
     * @param array $criteria
     * @return array
     */
    public function getStateList($criteria = [])
    {
        $return = [];

        $states = $this->find($criteria);

        foreach ($states as $state) {
            $return[$state->getId()] = $state->langs[$this->lang]->getTitle();
        }

        return $return;
    }
}
