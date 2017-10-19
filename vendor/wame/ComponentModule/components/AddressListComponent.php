<?php

namespace Wame\LocationModule\Vendor\Wame\ComponentModule;

use Nette\Application\LinkGenerator;
use Wame\ComponentModule\Registers\IComponent;
use Wame\MenuModule\Models\Item;
use Wame\LocationModule\Components\IAddressListControlFactory;


interface IAddressListComponentFactory
{
	/** @return AddressListComponent */
	public function create();
}


class AddressListComponent implements IComponent
{
	/** @var LinkGenerator */
	private $linkGenerator;

	/** @var IAddressListControlFactory */
	private $IAddressListControlFactory;


	public function __construct(
		LinkGenerator $linkGenerator,
        IAddressListControlFactory $IAddressListControlFactory
	) {
		$this->linkGenerator = $linkGenerator;
		$this->IAddressListControlFactory = $IAddressListControlFactory;
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
		return 'addressList';
	}


	public function getTitle()
	{
		return _('Address list');
	}


	public function getDescription()
	{
		return _('Create address list');
	}


	public function getIcon()
	{
		return 'fa fa-info';
	}


	public function getLinkCreate()
	{
		return $this->linkGenerator->link('Admin:AddressListComponent:create');
	}


	public function getLinkDetail($componentEntity)
	{
		return $this->linkGenerator->link('Admin:AddressListComponent:edit', ['id' => $componentEntity->id]);
	}


	public function createComponent()
	{
		$control = $this->IAddressListControlFactory->create();

		return $control;
	}

}
