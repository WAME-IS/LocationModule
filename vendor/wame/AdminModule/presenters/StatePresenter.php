<?php

namespace App\AdminModule\Presenters;

use Wame\LocationModule\Entities\StateEntity;
use Wame\LocationModule\Repositories\StateRepository;
use Wame\LocationModule\Vendor\Wame\AdminModule\Forms\StateForm;


class StatePresenter extends BasePresenter
{
	/** @var StateRepository @inject */
	public $stateRepository;
	
	/** @var StateForm @inject */
	public $stateForm;
	
	/** @var StateEntity */
	private $stateEntity;

	
	public function actionCreate()
	{
		if (!$this->user->isAllowed('admin.state', 'create')) {
			$this->flashMessage(_('To enter this section you do not have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:', ['id' => null]);
		}
	}
	

	public function actionEdit()
	{
		if (!$this->user->isAllowed('admin.state', 'edit')) {
			$this->flashMessage(_('To enter this section you do not have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:', ['id' => null]);
		}

		if (!$this->id) {
			$this->flashMessage(_('Missing identifier.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'State']);
		}

		$this->stateEntity = $this->stateRepository->get(['id' => $this->id]);
		
		if (!$this->stateEntity) {
			$this->flashMessage(_('This state does not exist.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'State']);
		}
		
		if ($this->stateEntity->status == StateRepository::STATUS_REMOVE) {
			$this->flashMessage(_('This state is removed.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'State']);
		}
	}
	
	
	public function actionDelete()
	{
		if (!$this->user->isAllowed('admin.state', 'delete')) {
			$this->flashMessage(_('To enter this section you do not have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:', ['id' => null]);
		}
		
		if (!$this->id) {
			$this->flashMessage(_('Missing identifier.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'State']);
		}
		
		$this->stateEntity = $this->stateRepository->get(['id' => $this->id]);
		
		if (!$this->stateEntity) {
			$this->flashMessage(_('This state does not exist.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'State']);
		}
		
		if ($this->stateEntity->status == StateRepository::STATUS_REMOVE) {
			$this->flashMessage(_('This state is removed.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'State']);
		}
	}

	
	protected function createComponentStateForm()
	{
		$form = $this->stateForm
						->setId($this->id)
						->build();
		
		return $form;
	}
	
	
	public function renderCreate()
	{	
		$this->template->setFile(__DIR__ . '/templates/State/detail.latte');

		$this->template->siteTitle = _('Create');
	}
	
	
	public function renderEdit()
	{	
		$this->template->setFile(__DIR__ . '/templates/State/detail.latte');

		$this->template->siteTitle = $this->stateEntity->langs[$this->lang]->getTitle();
		$this->template->stateEntity = $this->stateEntity;
	}
	
	
	
	public function renderDelete()
	{
		$this->template->siteTitle = _('Deleting state');
		$this->template->stateEntity = $this->stateEntity;
	}

	
	public function handleDelete()
	{
		if (!$this->user->isAllowed('admin.state', 'delete')) {
			$this->flashMessage(_('For this action you do not have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:');	
		}
		
		$this->stateRepository->changeStatus(['id' => $this->id]);
		
		$this->flashMessage(_('State has been successfully deleted.'), 'success');
		$this->redirect(':Admin:Settings:', ['id' => 'State']);
	}
	
}
