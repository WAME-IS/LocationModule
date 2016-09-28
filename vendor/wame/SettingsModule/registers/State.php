<?php 

namespace Wame\LocationModule\Vendor\Wame\SettingsModule\Registers;

use Wame\SettingsModule\Registers\Types\SettingsGroup;
//use Wame\LocationModule\Vendor\Wame\SettingsModule\Components\IStateListControlFactory;
use Wame\LocationModule\Repositories\StateRepository;
use Wame\LocationModule\Vendor\Wame\AdminModule\Grids\StateGrid;


class State extends SettingsGroup
{
//	/** @var IStateListControlFactory */
//	private $IStateListControlFactory;
	
	/** @var StateRepository */
	private $stateRepository;
	
	/** @var StateGrid */
	private $stateGrid;
	
	
	public function __construct(
        StateRepository $stateRepository,
        StateGrid $stateGrid
//		IStateListControlFactory $IStateListControlFactory
	) {
		parent::__construct();
		
//		$this->IStateListControlFactory = $IStateListControlFactory;
		$this->stateRepository = $stateRepository;
		$this->stateGrid = $stateGrid;
	}
	
	
	public function getComponentServices()
	{
//		$this->addService($this->IStateListControlFactory->create(), 'stateList');
		$this->addService($this->createComponentStateGrid(), 'stateGrid');
		
		return $this;
	}
	
	
	public function getTitle()
	{
		return _('States');
	}
    
    
	/**
	 * Unit grid component
	 * 
	 * @return UnitGrid
	 */
	protected function createComponentStateGrid()
	{
        $qb = $this->stateRepository->createQueryBuilder();
		$this->stateGrid->setDataSource($qb);
		
		return $this->stateGrid;
	}

}