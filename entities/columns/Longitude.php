<?php

namespace Wame\LocationModule\Entities\Columns;


trait Longitude
{
    /**
     * @ORM\Column(name="longitude", type="float", precision=10, scale=6)
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