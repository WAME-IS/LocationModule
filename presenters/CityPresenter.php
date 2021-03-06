<?php

namespace App\LocationModule\Presenters;

use App\Core\Presenters\BasePresenter;
use Wame\LocationModule\Repositories\CityRepository;

class CityPresenter extends BasePresenter
{
	/** @var CityRepository @inject */
	public $cityRepository;

    
    /**
     * Create address from Google Map API
     */
    public function handleCreateCityFromGoogleMapApi()
    {
        $address = $this->getParameter('address');
        
        $cityEntity = $this->cityRepository->createIfNotExists($address);
        
        if ($this->isAjax()) {
            $this->payload->cityId = $cityEntity->getId();
            $this->sendPayload();
        } else {
            $this->flashMessage(_('City is successfully created.'), 'success');
            $this->redirect('this');
        }
    }

}
