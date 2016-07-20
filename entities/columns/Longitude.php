<?php

namespace Wame\LocationModule\Entities\Columns;


trait Longitude
{
    /**
     * @ORM\Column(name="longitude", type="decimal", precision=15, scale=15)
     */
    protected $longitude;


	/** get ************************************************************/

	public function getLongitude()
	{
		return $this->longitude;
	}


	/** set ************************************************************/

	public function setLongitude($longitude)
	{
		$this->longitude = $longitude;
		
		return $this;
	}

}