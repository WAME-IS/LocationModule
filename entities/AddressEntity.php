<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\LocationModule\Entities\Columns\State;

/**
 * @ORM\Table(name="wame_address")
 * @ORM\Entity
 */
class AddressEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;
	use Columns\Status;
	use Columns\Title;
	use Columns\Token;
	use Columns\User;
	use State;

    /**
     * @ORM\Column(name="street", type="string", length=150, nullable=true)
     */
    protected $street;

    /**
     * @ORM\Column(name="house_number", type="string", length=30, nullable=true)
     */
    protected $houseNumber;

    /**
     * @ORM\Column(name="zip_code", type="string", length=10, nullable=true)
     */
    protected $zipCode;

    /**
     * @ORM\Column(name="city", type="string", length=50, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(name="main", type="boolean")
     */
    protected $main = false;
	
	
	/** getters ***************************************************************/
	
	public function getStreet()
	{
		return $this->street;
	}
	
	public function getHouseNumber()
	{
		return $this->houseNumber;
	}
	
	public function getZipCode()
	{
		return $this->zipCode;
	}
	
	public function getCity()
	{
		return $this->city;
	}
	
	public function getMain()
	{
		return $this->main;
	}
	
	
	/** setters ***************************************************************/
	
	public function setStreet($street)
	{
		$this->street = $street;
	}
	
	public function setHouseNumber($houseNumber)
	{
		$this->houseNumber = $houseNumber;
	}
	
	public function setZipCode($zipCode)
	{
		$this->zipCode = $zipCode;
	}
	
	public function setCity($city)
	{
		$this->city = $city;
	}
	
	public function setMain($main)
	{
		$this->main = $main;
	}
	
}