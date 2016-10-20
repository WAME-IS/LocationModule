<?php

namespace Wame\LocationModule\Repositories;

use Wame\LanguageModule\Repositories\TranslatableRepository;
use Wame\LocationModule\Entities\ContinentEntity;
use Wame\LocationModule\Entities\ContinentLangEntity;


class ContinentRepository extends TranslatableRepository
{
    const STATUS_REMOVED = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;


    public function __construct()
    {
        parent::__construct(ContinentEntity::class, ContinentLangEntity::class);
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


    /**
     * Get continent list
     *
     * @return array
     */
    public function getContinentList()
    {
        $return = [];

        $continents = $this->find([]);

        foreach ($continents as $continent) {
            $return[$continent->getId()] = $continent->getTitle();
        }

        return $return;
    }

}
