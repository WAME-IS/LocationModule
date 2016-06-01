<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_address")
 * @ORM\Entity
 */
class AddressEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;
	use Columns\Status;
	use Columns\Token;
	use Columns\User;

    /**
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    protected $title;

    /**
     * @ORM\Column(name="street", type="string", length=150, nullable=false)
     */
    protected $street;

    /**
     * @ORM\Column(name="house_number", type="string", length=30, nullable=false)
     */
    protected $houseNumber;

    /**
     * @ORM\Column(name="zip_code", type="string", length=10, nullable=false)
     */
    protected $zipCode;

    /**
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    protected $city;

    /**
 	 * @ORM\ManyToOne(targetEntity="StateEntity")
	 * @ORM\JoinColumn(name="state_id", referencedColumnName="id", nullable=true)
     */
    protected $state;

    /**
     * @ORM\Column(name="main", type="boolean")
     */
    protected $main = false;

}