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
	use Columns\Title;

	/**
     * @ORM\ManyToOne(targetEntity="StateEntity", inversedBy="langs")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id", nullable=false)
     */
	protected $state;

    /**
     * @ORM\Column(name="capital_city", type="string", length=50, nullable=false)
     */
    protected $capitalCity;

	
	/** getters ***************************************************************/
	
	public function getState()
	{
		return $this->state;
	}
	
	public function getCapitalCity()
	{
		return $this->capitalCity;
	}
	
	
	/** setters ***************************************************************/

	public function setState($state)
	{
		$this->state = $state;
	}
	
	public function setCapitalCity($capitalCity)
	{
		$this->capitalCity = $capitalCity;
	}
	
}