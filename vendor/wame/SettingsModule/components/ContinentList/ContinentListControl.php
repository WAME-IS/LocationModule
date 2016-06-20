<?php 

namespace Wame\LocationModule\Vendor\Wame\SettingsModule\Components;

use Wame\Core\Components\BaseControl;
use Wame\LocationModule\Repositories\ContinentRepository;


interface IContinentListControlFactory
{
	/** @return ContinentListControl */
	public function create();	
}


class ContinentListControl extends BaseControl
{
	/** @var ContinentRepository */
	private $continentRepository;
	
	
	public function __construct(
		ContinentRepository $continentRepository
	) {
		parent::__construct();
		
		$this->continentRepository = $continentRepository;
	}
	
	
	public function render()
	{
		$this->template->continents = $this->continentRepository->find(['status !=' => ContinentRepository::STATUS_REMOVED]);
		$this->componentRender();
	}

}