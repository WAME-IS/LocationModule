<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\Core\Entities\BaseLangEntity;

/**
 * @ORM\Table(name="wame_continent_lang")
 * @ORM\Entity
 */
class ContinentLangEntity extends BaseLangEntity
{
	use Columns\Identifier;
	use Columns\EditDate;
	use Columns\EditUser;
	use Columns\Lang;
	use Columns\Title;
	use Columns\Slug;

	/**
     * @ORM\ManyToOne(targetEntity="ContinentEntity", inversedBy="langs")
     * @ORM\JoinColumn(name="continent_id", referencedColumnName="id", onDelete="SET NULL")
     */
	protected $continent;


	/** get ************************************************************/

	public function getContinent()
	{
		return $this->continent;
	}


	/** set ************************************************************/

	public function setContinent($continent)
	{
		$this->continent = $continent;

		return $this;
	}
    
    
    /** {@inheritDoc} */
    public function setEntity($entity)
    {
        $this->continent = $entity;
    }

}