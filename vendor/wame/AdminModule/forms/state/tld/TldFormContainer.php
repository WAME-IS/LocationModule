<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State;

use Wame\DynamicObject\Forms\BaseFormContainer;


interface ITldFormContainerFactory
{
	/** @return TldFormContainer */
	public function create();
}


class TldFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('tld', _('National web domain'));
    }
	
	
	public function setDefaultValues($stateForm)
	{
		$form = $this->getForm();
		
		$form['tld']->setDefaultValue($stateForm->stateEntity->tld);
	}

}