<?php

namespace Wame\LocationModule\Forms;

use Wame\Core\Forms\FormFactory;
use Wame\ComponentModule\Forms\ComponentForm;


class AddressComponentForm extends FormFactory
{	
	/** @var ComponentForm */
	private $componentForm;
	
	/** @var string */
	private $type;
	
	
	public function __construct(
		ComponentForm $componentForm
	) {
        parent::__construct();
        
		$this->componentForm = $componentForm;
	}
	
	
	public function build() 
	{
		$form = $this->componentForm
					->setType($this->type)
					->setId($this->id)
					->build();

		return $form;
	}
	
	
	/**
	 * Set component type
	 *
     * @param string $type
     * @return $this
     */
	public function setType($type)
	{
		$this->type = $type;
		
		return $this;
	}

}
