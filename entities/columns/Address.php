<?php

namespace Wame\LocationModule\Entities\Columns;

trait Address
{
    /**
	 * @ORM\ManyToOne(targetEntity="\Wame\LocationModule\Entities\AddressEntity")
	 * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=true)
	 */
	protected $address;

	
	/** get ************************************************************/

	public function getAddress()
	{
		return $this->address;
	}


	/** set ************************************************************/

	public function setAddress($address)
	{
		$this->address = $address;
		
		return $this;
	}
	
}