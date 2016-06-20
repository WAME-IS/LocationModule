<?php 

namespace Wame\LocationModule\Vendor\Wame\SettingsModule\Models;

use Wame\SettingsModule\Models\SettingsType;
use Wame\LocationModule\Vendor\Wame\SettingsModule\Components\IStateListControlFactory;


class State extends SettingsType
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