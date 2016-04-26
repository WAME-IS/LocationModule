<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use \Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_state_lang")
 * @ORM\Entity
 */
class StateLangEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;

	/**
     * @ORM\ManyToOne(targetEntity="StateEntity", inversedBy="langs")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id", nullable=false)
     */
	protected $state;

	/**
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    protected $title;

    /**
     * @ORM\Column(name="capital_city", type="string", length=50, nullable=false)
     */
    protected $capitalCity;

}