<?php

namespace App\AdminModule\Presenters;

use Wame\LocationModule\Entities\ContinentEntity;
use Wame\LocationModule\Repositories\ContinentRepository;
use Wame\LocationModule\Vendor\Wame\AdminModule\Forms\ContinentForm;


class ContinentPresenter extends BasePresenter
{
	/** @var ContinentRepository @inject */
	public $continentRepository;
	
	/** @var ContinentForm @inject */
	public $continentForm;
	
	/** @var ContinentEntity */
	private $continentEntity;


	public function actionEdit()
	{
		if (!$this->user->isAllowed('admin.continent', 'edit')) {
			$this->flashMessage(_('To enter this section you do not have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:', ['id' => null]);
		}

		if (!$this->id) {
			$this->flashMessage(_('Missing identifier.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'Continent']);
		}

		$this->continentEntity = $this->continentRepository->get(['id' => $this->id]);
		
		if (!$this->continentEntity) {
			$this->flashMessage(_('This continent does not exist.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'Continent']);
		}
		
		if ($this->continentEntity->status == ContinentRepository::STATUS_REMOVED) {
			$this->flashMessage(_('This continent is removed.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'Continent']);
		}
	}

	
	protected function createComponentContinentForm()
	{
		$form = $this->continentForm
						->setId($this->id)
						->build();
		
		return $form;
	}
	
	
	public function renderEdit()
	{
		$this->template->siteTitle = $this->continentEntity->langs[$this->lang]->getTitle();
		$this->template->continentEntity = $this->continentEntity;
	}
	
}
