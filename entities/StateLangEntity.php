<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\Core\Entities\BaseLangEntity;

/**
 * @ORM\Table(name="wame_state_lang")
 * @ORM\Entity
 */
class StateLangEntity extends BaseLangEntity
{
	use Columns\Identifier;
	use Columns\Lang;
	use Columns\Title;
	use Columns\Slug;

	/**
     * @ORM\ManyToOne(targetEntity="StateEntity", inversedBy="langs")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id", nullable=false)
     */
	protected $state;

    /**
     * @ORM\Column(name="capital_city", type="string", length=50, nullable=false)
     */
    protected $capitalCity;


	/** get ************************************************************/

	public function getState()
	{
		return $this->state;
	}

	public function getCapitalCity()
	{
		return $this->capitalCity;
	}


	/** set ************************************************************/

	public function setState($state)
	{
		$this->state = $state;
		
		return $this;
	}

	public function setCapitalCity($capitalCity)
	{
		$this->capitalCity = $capitalCity;
		
		return $this;
	}
    
    
    /** {@inheritDoc} */
    public function setEntity($entity)
    {
        $this->state = $entity;
    }

}