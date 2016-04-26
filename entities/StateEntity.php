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

}