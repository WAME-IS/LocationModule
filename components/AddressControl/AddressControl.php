<?php 

namespace Wame\LocationModule\Components;

use Wame\Core\Components\BaseControl;
use Wame\LocationModule\Entities\AddressEntity;


interface IAddressControlFactory
{
	/** @return AddressControl */
	public function create();	
}


class AddressControl extends BaseControl
{
	public function render($addressEntity = null)
	{
        if (!$addressEntity) {
            $addressEntity = $this->getStatus()->get(AddressEntity::class);
        }
        
		$this->template->address = $addressEntity;
	}

}