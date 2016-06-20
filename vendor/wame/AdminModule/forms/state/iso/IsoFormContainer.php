<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;


interface IIsoFormContainerFactory
{
	/** @return IsoFormContainer */
	public function create();
}


class IsoFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('iso', _('ISO shortcut'))
				->setRequired(_('Please enter iso shortcut'))
				->addRule(Form::LENGTH, _('Must be %d characters'), 3);
    }
	
	
	public function setDefaultValues($stateForm)
	{
		$form = $this->getForm();
		
		$form['iso']->setDefaultValue($stateForm->stateEntity->iso);
	}

}