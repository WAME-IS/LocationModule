<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use \Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_continent")
 * @ORM\Entity
 */
class ContinentEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\EditDate;
	use Columns\EditUser;
	use Columns\Identifier;
	use Columns\Status;
	use Columns\Token;

    /**
     * @ORM\Column(name="code", type="string", length=2, nullable=false)
     */
    protected $code;

	/**
     * @ORM\OneToMany(targetEntity="ContinentLangEntity", mappedBy="continent")
     */
    protected $langs;

	
	/** getters ***************************************************************/
	
	public function getCode()
	{
		return $this->code;
	}
	
	
	/** setters ***************************************************************/

	public function setCode($code)
	{
		$this->code = $code;
	}
	
}