<?php

namespace Wame\LocationModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Wame\ComponentModule\Registers\IComponent;
use Wame\MenuModule\Models\Item;
use Wame\LocationModule\Components\IAddressControlFactory;


interface IAddressComponentFactory
{
	/** @return AddressComponent */
	public function create();	
}


class AddressComponent implements IComponent
{	
	/** @var LinkGenerator */
	private $linkGenerator;

	/** @var IAddressControlFactory */
	private $IAddressControlFactory;

	
	public function __construct(
		LinkGenerator $linkGenerator,
		IAddressControlFactory $IAddressControlFactory
	) {
		$this->linkGenerator = $linkGenerator;
		$this->IAddressControlFactory = $IAddressControlFactory;
	}
	
	
	public function addItem()
	{
		$item = new Item();
		$item->setName($this->getName());
		$item->setTitle($this->getTitle());
		$item->setDescription($this->getDescription());
		$item->setLink($this->getLinkCreate());
		$item->setIcon($this->getIcon());
		
		return $item->getItem();
	}
	
    
	public function getName()
	{
		return 'address';
	}
	
	
	public function getTitle()
	{
		return _('Address');
	}
	
	
	public function getDescription()
	{
		return _('Create address');
	}
	
	
	public function getIcon()
	{
		return 'fa fa-info';
	}
	
	
	public function getLinkCreate()
	{
		return $this->linkGenerator->link('Admin:Address:component');
	}

	
	public function getLinkDetail($componentEntity)
	{
		return $this->linkGenerator->link('Admin:Address:component', ['id' => $componentEntity->id]);
	}
	
	
	public function createComponent()
	{
		$control = $this->IAddressControlFactory->create();
		return $control;
	}

}