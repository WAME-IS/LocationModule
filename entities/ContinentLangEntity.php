<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use \Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_continent_lang")
 * @ORM\Entity
 */
class ContinentLangEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;

	/**
     * @ORM\ManyToOne(targetEntity="ContinentEntity", inversedBy="langs")
     * @ORM\JoinColumn(name="continent_id", referencedColumnName="id", nullable=false)
     */
	protected $continent;

    /**
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     */
    protected $title;
	
	
	/** getters ***************************************************************/
	
	public function getContinent()
	{
		return $this->continent;
	}
	
	
	/** setters ***************************************************************/

	public function setContinent($continent)
	{
		$this->continent = $continent;
	}

}