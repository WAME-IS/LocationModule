<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\Core\Entities\TranslatableEntity;
use Wame\LocationModule\Entities\Columns\Latitude;
use Wame\LocationModule\Entities\Columns\Longitude;
use Wame\LocationModule\Entities\Columns\State;


/**
 * @ORM\Table(name="wame_city")
 * @ORM\Entity
 */
class CityEntity extends TranslatableEntity
{
    use Columns\Identifier;
    use Columns\EditDate;
    use Columns\EditUser;
    use Columns\Status;
    use Columns\Token;
    use Columns\Parameters;
    use Latitude;
    use Longitude;
    use State;

    
    /**
     * @ORM\OneToMany(targetEntity="CityLangEntity", mappedBy="city")
     */
    protected $langs;

    /**
     * @ORM\ManyToOne(targetEntity="RegionEntity")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id", nullable=true)
     */
    protected $region;

    /**
     * @ORM\Column(name="import_id", type="string", nullable=true)
     */
    protected $importId;

    /**
     * @ORM\Column(name="zip_code", type="string", nullable=true)
     */
    protected $zipCode;

    
    /** get *********************************************************** */

    public function getRegion()
    {
        return $this->region;
    }

    public function getImportId()
    {
        return $this->importId;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    
    /** set *********************************************************** */

    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    public function setImportId($importId)
    {
        $this->importId = $importId;

        return $this;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = \Nette\Utils\Strings::trim(str_replace(' ', '', $zipCode));

        return $this;
    }

}
