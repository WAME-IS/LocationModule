<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\Continent;

use Wame\DynamicObject\Forms\BaseFormContainer;


interface ITitleFormContainerFactory
{
	/** @return TitleFormContainer */
	public function create();
}


class TitleFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();

		$form->addText('title', _('Title'))
				->setRequired(_('Please enter title'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$form['title']->setDefaultValue($object->continentEntity->langs[$object->lang]->title);
	}

}