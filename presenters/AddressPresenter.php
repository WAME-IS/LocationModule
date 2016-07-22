<?php

namespace App\LocationModule\Presenters;

use App\Core\Presenters\BasePresenter;
use Wame\LocationModule\Repositories\AddressRepository;


class AddressPresenter extends BasePresenter
{
	/** @var AddressRepository @inject */
	public $addressRepository;

    
    /**
     * Create address from Google Map API
     */
    public function handleCreateAddressFromGoogleMapApi()
    {
        $address = $this->getParameter('address');
        
        $addressEntity = $this->addressRepository->createAddressFromGoogleMapApi($address);
        
        if ($this->isAjax()) {
            $this->payload->addressId = $addressEntity->getId();
            $this->sendPayload();
        } else {
            $this->flashMessage(_('City is successfully created.'), 'success');
            $this->redirect('this');
        }
    }

}
