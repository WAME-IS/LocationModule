<?php 

namespace Wame\LocationModule\Vendor\Wame\SettingsModule\Registers;

use Wame\SettingsModule\Registers\Types\SettingsGroup;
use Wame\LocationModule\Repositories\ContinentRepository;
use Wame\LocationModule\Vendor\Wame\AdminModule\Grids\ContinentGrid;


class Continent extends SettingsGroup
{
	/** @var ContinentRepository */
	private $continentRepository;
    
	/** @var ContinentGrid */
	private $continentGrid;
	
	
	public function __construct(
		ContinentRepository $continentRepository,
		ContinentGrid $continentGrid
	) {
		parent::__construct();
		
		$this->continentRepository = $continentRepository;
		$this->continentGrid = $continentGrid;
	}
	
	
	public function getComponentServices()
	{
		$this->addService($this->createComponentContinentGrid(), 'continentGrid');
		
		return $this;
	}
	
	
	public function getTitle()
	{
		return _('Continents');
	}

    
	protected function createComponentContinentGrid()
	{
        $qb = $this->continentRepository->createQueryBuilder();
		$this->continentGrid->setDataSource($qb);
		
		return $this->continentGrid;
	}

}