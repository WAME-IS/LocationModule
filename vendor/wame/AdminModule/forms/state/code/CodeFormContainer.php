<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;


interface ICodeFormContainerFactory
{
	/** @return CodeFormContainer */
	public function create();
}


class CodeFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('code', _('Code'))
				->setRequired(_('Please enter code'))
				->addRule(Form::LENGTH, _('Must be %d characters'), 2);
    }
	
	
	public function setDefaultValues($stateForm)
	{
		$form = $this->getForm();
		
		$form['code']->setDefaultValue($stateForm->stateEntity->code);
	}

}