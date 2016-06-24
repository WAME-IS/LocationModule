<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State;

use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\LocationModule\Repositories\ContinentRepository;


interface IContinentFormContainerFactory
{
	/** @return ContinentFormContainer */
	public function create();
}


class ContinentFormContainer extends BaseFormContainer
{
	/** @var ContinentRepository */
	private $continentRepository;
	
	/** @var string */
	private $lang;
	
	/** @var array */
	private $continentList;


	public function __construct(
		ContinentRepository $continentRepository
	) {
		parent::__construct();
		
		$this->continentRepository = $continentRepository;
		$this->lang = $continentRepository->lang;

		$this->continentList = $this->getContinents();
	}


	private function getContinents()
	{
		$return = [];
		
		$continentEntity = $this->continentRepository->find(['status !=' => ContinentRepository::STATUS_REMOVED]);

		foreach ($continentEntity as $continent) {
			$return[$continent->getId()] = $continent->langs[$this->lang]->getTitle();
		}
		
		return $return;
	}


    public function configure() 
	{
		$form = $this->getForm();

		$form->addSelect('continent', _('Continent'), $this->continentList)
				->setPrompt('- ' . _('Select continent') . ' -')
				->setRequired(_('Please select continent'));
    }


	public function setDefaultValues($stateForm)
	{
		$form = $this->getForm();

		if (isset($this->continentList[$stateForm->stateEntity->continent->id])) {
			$form['continent']->setDefaultValue($stateForm->stateEntity->continent->id);
		}
	}

}