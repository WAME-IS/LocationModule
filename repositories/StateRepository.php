<?php

namespace Wame\LocationModule\Repositories;

use Nette\Utils\Strings;
use Wame\Core\Exception\RepositoryException;
use Wame\LanguageModule\Repositories\TranslatableRepository;
use Wame\LocationModule\Entities\StateEntity;
use Wame\LocationModule\Entities\StateLangEntity;


class StateRepository extends TranslatableRepository
{
    const STATUS_REMOVE = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;


    public function __construct()
    {
        parent::__construct(StateEntity::class, StateLangEntity::class);
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
     * @param array $withoutIds
     * @return array
     */
    public function getStateList($criteria = [], $withoutIds = [])
    {
        $return = [];

        if (!is_array($withoutIds)) {
            $withoutIds = [$withoutIds];
        }

        if (count($withoutIds) > 0) {
            $criteria['id NOT IN'] = $withoutIds;
        }

        $states = $this->find($criteria);

        foreach ($states as $state) {
            $return[$state->getId()] = Strings::upper($state->getCode()) . ' - ' . $state->getTitle();
        }

        return $return;
    }

}
