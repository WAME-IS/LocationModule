<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Nette\Utils\Strings;
use Wame\Core\Entities\Columns;

/**
 * @ORM\Table(name="wame_continent")
 * @ORM\Entity
 */
class ContinentEntity extends \Wame\LanguageModule\Entities\TranslatableEntity
{
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


	/** get ************************************************************/

	public function getCode()
	{
		return $this->code;
	}


	/** set ************************************************************/

	public function setCode($code)
	{
		$this->code = Strings::lower($code);
		
		return $this;
	}

}