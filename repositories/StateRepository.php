<?php

namespace Wame\LocationModule\Repositories;

use Wame\LocationModule\Entities\StateEntity;


class StateRepository extends \Wame\Core\Repositories\BaseRepository
{
	const STATUS_REMOVE = 0;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;


	public function __construct(
		\Nette\DI\Container $container, 
		\Kdyby\Doctrine\EntityManager $entityManager, 
		\h4kuna\Gettext\GettextSetup $translator, 
		\Nette\Security\User $user
	) {
		parent::__construct($container, $entityManager, $translator, $user, StateEntity::class);
	}
	

	/**
	 * Create state
	 * 
	 * @param StateEntity $stateEntity
	 * @return StateEntity
	 * @throws \Wame\Core\Exception\RepositoryException
	 */
	public function create($stateEntity)
	{
		$create = $this->entityManager->persist($stateEntity);
		
		$this->entityManager->persist($stateEntity->langs);
		
		if (!$create) {
			throw new \Wame\Core\Exception\RepositoryException(_('State could not be created.'));
		}
		
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
	
}