<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State;

use Wame\DynamicObject\Forms\BaseFormContainer;


interface IPhonePrefixFormContainerFactory
{
	/** @return PhonePrefixFormContainer */
	public function create();
}


class PhonePrefixFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('phonePrefix', _('Phone prefix'));
    }
	
	
	public function setDefaultValues($stateForm)
	{
		$form = $this->getForm();
		
		$form['phonePrefix']->setDefaultValue($stateForm->stateEntity->phonePrefix);
	}

}