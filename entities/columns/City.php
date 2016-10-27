<?php

namespace Wame\LocationModule\Entities\Columns;

trait City
{
    /**
	 * @ORM\ManyToOne(targetEntity="\Wame\LocationModule\Entities\CityEntity", cascade={"persist"})
	 * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=true)
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

}