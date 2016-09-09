<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\BaseLangEntity;
use Wame\Core\Entities\Columns;


/**
 * @ORM\Table(name="wame_city_lang")
 * @ORM\Entity
 */
class CityLangEntity extends BaseLangEntity
{
	use Columns\Identifier;
	use Columns\Lang;
	use Columns\Title;
	use Columns\Slug;


	/**
     * @ORM\ManyToOne(targetEntity="CityEntity", inversedBy="langs")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     */
	protected $city;
    

	/** get ************************************************************/

	public function getCity()
	{
		return $this->city;
	}


	/** set ************************************************************/

	public function setCity($city)
	{
		$this->city = $city;
		
		return $this;
	}
    
    
    /** {@inheritDoc} */
    public function setEntity($entity)
    {
        $this->city = $entity;
    }

}