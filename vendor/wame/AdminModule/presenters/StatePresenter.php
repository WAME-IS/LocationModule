<?php

namespace App\AdminModule\Presenters;

use Wame\LocationModule\Entities\StateEntity;
use Wame\LocationModule\Repositories\StateRepository;
use Wame\DynamicObject\Vendor\Wame\AdminModule\Presenters\AdminFormPresenter;


class StatePresenter extends AdminFormPresenter
{
	/** @var StateRepository @inject */
	public $repository;

	/** @var StateEntity */
	protected $entity;


    /** actions ************************************************************** */

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

		$this->entity = $this->repository->get(['id' => $this->id]);

		if (!$this->entity) {
			$this->flashMessage(_('This state does not exist.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'State']);
		}

		if ($this->entity->status == StateRepository::STATUS_REMOVE) {
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

		$this->entity = $this->repository->get(['id' => $this->id]);

		if (!$this->entity) {
			$this->flashMessage(_('This state does not exist.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'State']);
		}

		if ($this->entity->getStatus() == StateRepository::STATUS_REMOVE) {
			$this->flashMessage(_('This state is removed.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'State']);
		}
	}

    /** handles ***************************************************** */

    public function handleDelete()
	{
		if (!$this->user->isAllowed('admin.state', 'delete')) {
			$this->flashMessage(_('For this action you do not have enough privileges.'), 'danger');
			$this->redirect(':Admin:Dashboard:');
		}

		$this->repository->changeStatus(['id' => $this->id]);

		$this->flashMessage(sprintf(_('State %s has been successfully deleted.'), $this->entity->getTitle()), 'success');
		$this->redirect(':Admin:Settings:', ['id' => 'State']);
	}


    /** renders ***************************************************** */

	public function renderDefault()
	{
		$this->template->siteTitle = _('States');
	}


	public function renderCreate()
	{
		$this->template->siteTitle = _('Create state');
	}


	public function renderEdit()
	{
		$this->template->siteTitle = $this->entity->getTitle();
	}


	public function renderDelete()
	{
		$this->template->siteTitle = _('Deleting state');
		$this->template->stateEntity = $this->entity;
	}


    /** abstract methods ***************************************************** */

    /** {@inheritdoc} */
    protected function getFormBuilderServiceAlias()
    {
        return 'Admin.StateFormBuilder';
    }


    /** {@inheritdoc} */
    protected function getGridServiceAlias()
    {
        return 'Admin.StateGrid';
    }

}
