<?php

namespace Wame\LocationModule\Entities\Columns;


trait Latitude
{
    /**
     * @ORM\Column(name="latitude", type="decimal", precision=15, scale=14)
     */
    protected $latitude;


	/** get ************************************************************/

	public function getLatitude()
	{
		return $this->latitude;
	}


	/** set ************************************************************/

	public function setLatitude($latitude)
	{
		$this->latitude = $latitude;
		
		return $this;
	}

}