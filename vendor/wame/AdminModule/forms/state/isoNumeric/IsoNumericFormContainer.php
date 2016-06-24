<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;


interface IIsoNumericFormContainerFactory
{
	/** @return IsoNumericFormContainer */
	public function create();
}


class IsoNumericFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('isoNumeric', _('ISO numeric code'))
				->addRule(Form::INTEGER, _('Must be a number'), '.*[0-9].*');
    }


	public function setDefaultValues($stateForm)
	{
		$form = $this->getForm();
		
		$form['isoNumeric']->setDefaultValue($stateForm->stateEntity->isoNumeric);
	}

}