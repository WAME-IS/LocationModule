<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\BaseEntity;
use Wame\Core\Entities\Columns;


/**
 * @ORM\Table(name="wame_region_lang")
 * @ORM\Entity
 */
class RegionLangEntity extends BaseEntity
{
	use Columns\Identifier;
	use Columns\Lang;
	use Columns\Title;
	use Columns\Slug;


	/**
     * @ORM\ManyToOne(targetEntity="RegionEntity", inversedBy="langs")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id", nullable=false)
     */
	protected $region;
    

	/** get ************************************************************/

	public function getRegion()
	{
		return $this->region;
	}


	/** set ************************************************************/

	public function setRegion($region)
	{
		$this->region = $region;
		
		return $this;
	}

}