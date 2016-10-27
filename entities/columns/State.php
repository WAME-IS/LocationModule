<?php

namespace Wame\LocationModule\Entities\Columns;

trait State
{
    /**
	 * @ORM\ManyToOne(targetEntity="\Wame\LocationModule\Entities\StateEntity", cascade={"persist"})
	 * @ORM\JoinColumn(name="state_id", referencedColumnName="id", nullable=true)
	 */
	protected $state;


	/** get ************************************************************/

	public function getState()
	{
		return $this->state;
	}


	/** set ************************************************************/

	public function setState($state)
	{
		$this->state = $state;
		
		return $this;
	}

}