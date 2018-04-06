<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\LocationModule\Entities\Columns\City;
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
	use City;
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
     * @ORM\Column(name="main", type="boolean")
     */
    protected $main = false;
	
	
	/** get *******************************************************************/
	
	public function getStreet()
	{
		return $this->street;
	}
	
	public function getHouseNumber()
	{
		return $this->houseNumber;
	}
	
	public function getMain()
	{
		return $this->main;
	}

	public function getFullAddress()
    {
        $return = '';

        // street
        if ($this->getStreet()) {
            $return .= $this->getStreet();

            // house number
            if ($this->getHouseNumber()) {
                $return .= $this->getHouseNumber();
            }

            $return .= ', ';
        }

        // city
        if ($this->getCity()) {
            if ($this->getCity()->getZipCode()) {
                $return .= $this->getCity()->getZipCode() . ' ';
            }

            $return .= $this->getCity()->title . ', ';
        }

        // state
        if ($this->getState()) {
            $return .= $this->getState()->title . ', ';
        }

        return substr($return, 0, -2);
    }
	
	
	/** set *******************************************************************/
	
	public function setStreet($street)
	{
		$this->street = $street;
        
        return $this;
	}
	
	public function setHouseNumber($houseNumber)
	{
		$this->houseNumber = $houseNumber;
        
        return $this;
	}
	
	public function setMain($main)
	{
		$this->main = $main;
        
        return $this;
	}
	
}