<?php 

namespace Wame\LocationModule\Vendor\Wame\SettingsModule\Registers;

use Wame\SettingsModule\Registers\Types\SettingsGroup;
use Wame\LocationModule\Vendor\Wame\SettingsModule\Components\IStateListControlFactory;


class State extends SettingsGroup
{
	/** @var IStateListControlFactory */
	private $IStateListControlFactory;
	
	
	public function __construct(
		IStateListControlFactory $IStateListControlFactory
	) {
		parent::__construct();
		
		$this->IStateListControlFactory = $IStateListControlFactory;
	}
	
	
	public function getComponentServices()
	{
		$this->addService($this->IStateListControlFactory->create(), 'stateList');
		
		return $this;
	}
	
	
	public function getTitle()
	{
		return _('States');
	}

}