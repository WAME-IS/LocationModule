<?php 

namespace Wame\LocationModule\Components;

use Wame\Core\Components\BaseControl;


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
            $addressEntity = $this->getStatus()->get('address');
        }
        
		$this->template->address = $addressEntity;
	}

}