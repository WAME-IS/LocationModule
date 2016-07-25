<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\LanguageModule\Entities\TranslatableEntity;
use Wame\LocationModule\Entities\Columns\State;


/**
 * @ORM\Table(name="wame_region")
 * @ORM\Entity
 */
class RegionEntity extends TranslatableEntity
{
    use Columns\Identifier;
    use Columns\EditDate;
    use Columns\EditUser;
    use Columns\Status;
    use Columns\Token;
    use State;

    
    /**
     * @ORM\OneToMany(targetEntity="RegionLangEntity", mappedBy="region")
     */
    protected $langs;
    
    /**
     * @ORM\OneToMany(targetEntity="CityEntity", mappedBy="id")
     */
    protected $cities;

    
    /** get *********************************************************** */
    
    public function getCities()
    {
        return $this->cities;
    }

}
