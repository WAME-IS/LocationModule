<?php

namespace App\AdminModule\Presenters;

use Wame\LocationModule\Entities\ContinentEntity;
use Wame\LocationModule\Repositories\ContinentRepository;
use Wame\DynamicObject\Vendor\Wame\AdminModule\Presenters\AdminFormPresenter;


class ContinentPresenter extends AdminFormPresenter
{
	/** @var ContinentRepository @inject */
	public $repository;

	/** @var ContinentEntity */
	protected $entity;


    /** actions ************************************************************** */

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

		$this->entity = $this->repository->get(['id' => $this->id]);

		if (!$this->entity) {
			$this->flashMessage(_('This continent does not exist.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'Continent']);
		}

		if ($this->entity->getStatus() == ContinentRepository::STATUS_REMOVED) {
			$this->flashMessage(_('This continent is removed.'), 'danger');
			$this->redirect(':Admin:Settings:', ['id' => 'Continent']);
		}
	}


    /** renders ***************************************************** */

	public function renderDefault()
	{
		$this->template->siteTitle = _('Continents');
	}

    public function renderEdit()
	{
		$this->template->siteTitle = $this->entity->getTitle();
	}


    /** abstract methods ***************************************************** */

    /** {@inheritdoc} */
    protected function getFormBuilderServiceAlias()
    {
        return 'Admin.ContinentFormBuilder';
    }


    /** {@inheritdoc} */
    protected function getGridServiceAlias()
    {
        return 'Admin.ContinentGrid';
    }

}
