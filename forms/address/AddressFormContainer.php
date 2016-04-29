<?php

namespace Wame\LocationModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\LocationModule\Repositories\AddressRepository;

interface IAddressFormContainerFactory
{
	/** @return AddressFormContainer */
	function create();
}


class AddressFormContainer extends BaseFormContainer
{
	/** @var AddressRepository */
	private $addressRepository;
	
	public function __construct(AddressRepository $addressRepository) {
		parent::__construct();
		
		$this->addressRepository = $addressRepository;
	}
	
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
	
	
	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$address = $this->addressRepository->get(['user' => $object->id]);

		if ($address) {
			$form['street']->setDefaultValue($address->street);
			$form['houseNumber']->setDefaultValue($address->houseNumber);
			$form['zipCode']->setDefaultValue($address->zipCode);
			$form['city']->setDefaultValue($address->city);
		}
	}
	
}