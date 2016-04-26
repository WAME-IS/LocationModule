<?php

namespace Wame\LocationModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;

interface IAddressFormContainerFactory
{
	/** @return AddressFormContainer */
	function create();
}

class AddressFormContainer extends BaseFormContainer
{
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

    protected function configure() 
	{		
		$form = $this->getForm();
		
		$form->addGroup(_('Address'));
		
        $form->addText('street', _('Street'));
		
        $form->addText('houseNumber', _('House number'));
		
        $form->addText('zipCode', _('Zip code'));
		
        $form->addText('city', _('City'));
    }
	
}