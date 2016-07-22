<?php

namespace App\AdminModule\Presenters;

use Wame\LocationModule\Forms\AddressComponentForm;


class AddressPresenter extends BasePresenter
{
	/** @var AddressComponentForm @inject */
	public $addressComponentForm;

    
    /**
	 * Address component form
	 * 
	 * @return ComponentForm
	 */
	protected function createComponentAddressComponentForm()
	{
		$form = $this->addressComponentForm
						->setType('AddressComponent')
						->setId($this->id)
						->build();

		return $form;
	}
	
}
