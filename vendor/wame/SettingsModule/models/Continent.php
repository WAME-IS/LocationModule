<?php 

namespace Wame\LocationModule\Vendor\Wame\SettingsModule\Models;

use Wame\SettingsModule\Models\SettingsType;
use Wame\LocationModule\Vendor\Wame\SettingsModule\Components\IContinentListControlFactory;


class Continent extends SettingsType
{
	/** @var IContinentListControlFactory */
	private $IContinentListControlFactory;
	
	
	public function __construct(
		IContinentListControlFactory $IContinentListControlFactory
	) {
		parent::__construct();
		
		$this->IContinentListControlFactory = $IContinentListControlFactory;
	}
	
	
	public function getComponentServices()
	{
		$this->addService($this->IContinentListControlFactory->create(), 'continentList');
		
		return $this;
	}
	
	
	public function getTitle()
	{
		return _('Continents');
	}

}