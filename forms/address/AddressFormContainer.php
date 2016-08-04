<?php

namespace Wame\LocationModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\LocationModule\Repositories\AddressRepository;
use Wame\LocationModule\Repositories\StateRepository;


interface IAddressFormContainerFactory
{
	/** @return AddressFormContainer */
	function create();
}


class AddressFormContainer extends BaseFormContainer
{
	/** @var AddressRepository */
	private $addressRepository;

	/** @var array */
	private $stateList;


	public function __construct(
		AddressRepository $addressRepository,
		StateRepository $stateRepository
	) {
		parent::__construct();
		
		$this->addressRepository = $addressRepository;
		$this->stateList = $stateRepository->getStateList(['status' => StateRepository::STATUS_ENABLED]);
	}


    protected function configure() 
	{		
		$form = $this->getForm();
		
		$form->addGroup(_('Address'));
		
        $form->addText('street', _('Street'));
		
        $form->addText('houseNumber', _('House number'));
		
        $form->addText('zipCode', _('Zip code'));
		
        $form->addText('city', _('City'));
		
        $form->addSelect('state', _('State'), $this->stateList);
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$address = $this->addressRepository->get(['user' => $object->id]);

		if ($address) {
			$form['street']->setDefaultValue($address->street);
			$form['houseNumber']->setDefaultValue($address->houseNumber);
            if ($address->city) {
                $form['zipCode']->setDefaultValue($address->city->zipCode);
                $form['city']->setDefaultValue($address->city);
            }
            if ($address->state) {
                $form['state']->setDefaultValue($address->state->getId());
            }
		}
	}

}