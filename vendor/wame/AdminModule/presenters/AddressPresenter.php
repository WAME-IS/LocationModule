<?php

namespace App\AdminModule\Presenters;

use Wame\DynamicObject\Vendor\Wame\AdminModule\Presenters\AdminFormPresenter;
use Wame\LocationModule\Entities\AddressEntity;
use Wame\LocationModule\Entities\AddressItemEntity;
use Wame\LocationModule\Repositories\AddressItemRepository;
use Wame\LocationModule\Repositories\AddressRepository;


class AddressPresenter extends AdminFormPresenter
{
    /** @var AddressRepository @inject */
    public $repository;

    /** @var AddressItemRepository @inject */
    public $addressItemRepository;

    /** @var AddressEntity */
    protected $entity;

    /** @var AddressItemEntity */
    protected $item;

    /** @var string */
    public $type;


    /** actions ************************************************************** */

    public function actionCreate()
    {
        $this->type = $this->getParameter('t');
    }


    public function actionEdit()
    {
        $this->item = $this->addressItemRepository->get(['id' => $this->getId()]);
        $this->entity = $this->item->getAddress();
        $this->type = $this->item->getType();
    }


    public function actionDelete()
    {
        $this->item = $this->addressItemRepository->get(['id' => $this->getId()]);
        $this->entity = $this->item->getAddress();
        $this->type = $this->item->getType();
    }


    /** handles ***************************************************** */

    public function handleDelete()
	{
        $this->addressItemRepository->setNextAsMain($this->getId());
        $this->addressItemRepository->remove(['id' => $this->getId()]);

        $this->flashMessage(_('Succesfully removed'), 'success');
        $this->redirectUrl($this->getRefererUrl());
	}


    /** renders ***************************************************** */

    public function renderCreate()
    {
        $this->template->siteTitle = _('Add address');
    }


    public function renderEdit()
    {
        $this->template->siteTitle = _('Edit address');
        $this->template->subTitle = $this->getEntity()->getFullAddress();
        $this->template->entity = $this->getEntity();
    }


    public function renderDelete()
    {
        $this->template->siteTitle = _('Remove address');
        $this->template->subTitle = $this->getEntity()->getTitle();
        $this->template->entity = $this->getEntity();
    }


    /** abstract methods ***************************************************** */

    /** {@inheritdoc} */
    protected function getFormBuilderServiceAlias()
    {
        return 'AddressFormBuilder';
    }

}
