<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use \Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_state")
 * @ORM\Entity
 */
class StateEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\EditDate;
	use Columns\EditUser;
	use Columns\Identifier;
	use Columns\Status;
	use Columns\Token;

	/**
     * @ORM\OneToMany(targetEntity="StateLangEntity", mappedBy="state")
     */
    protected $langs;
	
	/**
     * @ORM\Column(name="code", type="string", length=2, nullable=false)
     */
    protected $code;

    /**
     * @ORM\Column(name="iso", type="string", length=3, nullable=false)
     */
    protected $iso;

    /**
     * @ORM\Column(name="iso_numeric", type="integer", length=3, nullable=false)
     */
    protected $isoNumeric;

    /**
     * @ORM\Column(name="phone_prefix", type="string", length=10, nullable=false)
     */
    protected $phonePrefix;

    /**
     * @ORM\Column(name="tld", type="string", length=10, nullable=false)
     */
    protected $tld;

    /**
     * @ORM\Column(name="flag", type="string", length=10, nullable=false)
     */
    protected $flag;

    /**
 	 * @ORM\ManyToOne(targetEntity="ContinentEntity")
	 * @ORM\JoinColumn(name="continent_id", referencedColumnName="id", nullable=false)
     */
    protected $continent;

	
	/** getters ***************************************************************/
	
	public function getCode()
	{
		return $this->code;
	}
	
	public function getIso()
	{
		return $this->iso;
	}
	
	public function getIsoNumeric()
	{
		return $this->isoNumeric;
	}
	
	public function getPhonePrefix()
	{
		return $this->phonePrefix;
	}
	
	public function getTld()
	{
		return $this->tld;
	}
	
	public function getFlag()
	{
		return $this->flag;
	}
	
	public function getContinent()
	{
		return $this->continent;
	}
	
	
	/** setters ***************************************************************/

	public function setCode($code)
	{
		$this->code = $code;
	}
	
	public function setIso($iso)
	{
		$this->iso = $iso;
	}
	
	public function setIsoNumeric($isoNumeric)
	{
		$this->isoNumeric = $isoNumeric;
	}
	
	public function setphonePrefix($phonePrefix)
	{
		$this->phonePrefix = $phonePrefix;
	}
	
	public function setTld($tld)
	{
		$this->tld = $tld;
	}
	
	public function setFlag($flag)
	{
		$this->flag = $flag;
	}
	
	public function setContinent($continent)
	{
		$this->continent = $continent;
	}
	
}