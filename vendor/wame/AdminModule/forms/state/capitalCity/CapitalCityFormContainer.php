<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State;

use Wame\DynamicObject\Forms\BaseFormContainer;


interface ICapitalCityFormContainerFactory
{
	/** @return CapitalCityFormContainer */
	public function create();
}


class CapitalCityFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('capitalCity', _('Capital city'))
				->setRequired(_('Please enter capital city'));
    }
	
	
	public function setDefaultValues($stateForm)
	{
		$form = $this->getForm();
		
		$form['capitalCity']->setDefaultValue($stateForm->stateEntity->langs[$stateForm->lang]->capitalCity);
	}

}