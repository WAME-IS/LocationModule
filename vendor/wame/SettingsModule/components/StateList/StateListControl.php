<?php 

namespace Wame\LocationModule\Vendor\Wame\SettingsModule\Components;

use Wame\Core\Components\BaseControl;
use Wame\LocationModule\Repositories\StateRepository;
use Wame\LocationModule\Vendor\Wame\SettingsModule\Forms\StateListForm;


interface IStateListControlFactory
{
	/** @return StateListControl */
	public function create();	
}


class StateListControl extends BaseControl
{
	/** @var StateRepository */
	private $stateRepository;
	
	/** @var StateListForm */
	public $stateListForm;
	
	/** @var array */
	private $states = [];	
	
	
	public function __construct(
		StateRepository $stateRepository,
		StateListForm $stateListForm
	) {
		parent::__construct();
		
		$this->stateRepository = $stateRepository;
		$this->stateListForm = $stateListForm;
	}
	
	
	protected function createComponentStateListForm()
	{
		$form = $this->stateListForm->build();
		
		return $form;
	}
	
	
	public function render()
	{
		$this->template->states = $this->stateRepository->find(['status !=' => StateRepository::STATUS_REMOVE]);
		$this->componentRender();
	}

}