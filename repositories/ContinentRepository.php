<?php

namespace Wame\LocationModule\Repositories;

use h4kuna\Gettext\GettextSetup;
use Kdyby\Doctrine\EntityManager;
use Nette\DI\Container;
use Nette\Security\User;
use Wame\LanguageModule\Repositories\TranslatableRepository;
use Wame\LocationModule\Entities\ContinentEntity;

class ContinentRepository extends TranslatableRepository
{

    const STATUS_REMOVED = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    public function __construct(
    Container $container, EntityManager $entityManager, GettextSetup $translator, User $user
    )
    {
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
