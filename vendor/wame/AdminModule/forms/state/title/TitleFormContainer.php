<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State;

use Wame\DynamicObject\Forms\BaseFormContainer;


interface ITitleFormContainerFactory
{
	/** @return TitleFormContainer */
	public function create();
}


class TitleFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('title', _('Title'))
				->setRequired(_('Please enter title'));
    }
	
	
	public function setDefaultValues($stateForm)
	{
		$form = $this->getForm();
		
		$form['title']->setDefaultValue($stateForm->stateEntity->langs[$stateForm->lang]->title);
	}

}