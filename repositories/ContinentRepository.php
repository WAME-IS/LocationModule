<?php

namespace Wame\LocationModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\LocationModule\Entities\ContinentEntity;


class ContinentRepository extends BaseRepository
{
	const STATUS_REMOVED = 0;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;


	public function __construct(
		\Nette\DI\Container $container, 
		\Kdyby\Doctrine\EntityManager $entityManager, 
		\h4kuna\Gettext\GettextSetup $translator, 
		\Nette\Security\User $user
	) {
		parent::__construct($container, $entityManager, $translator, $user, ContinentEntity::class);
	}


	/**
	 * Update continent
	 * 
	 * @param ContinentEntity $continentEntity
	 * @return ContinentEntity
	 */
	public function update($continentEntity)
	{
		return $continentEntity;
	}
	
}