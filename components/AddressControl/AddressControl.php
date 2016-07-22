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
    /** @var AddressEntity */
    private $address;
    
    
	public function render($addressEntity = null)
	{
        if (!$addressEntity) {
            $this->getStatus()->get('address', function($value) {
                $this->address = $value;
            });
            
            $addressEntity = $this->address;
            
            $this->getStatus()->set('address', $addressEntity);
        }
        
		$this->template->address = $addressEntity;

		$this->componentRender();
	}

}