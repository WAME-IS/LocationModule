<?php

namespace App\LocationModule\Presenters;

use App\Core\Presenters\BasePresenter;
use Wame\LocationModule\Entities\AddressEntity;
use Wame\LocationModule\Entities\AddressItemEntity;
use Wame\LocationModule\Repositories\AddressItemRepository;
use Wame\LocationModule\Repositories\AddressRepository;


class AddressPresenter extends BasePresenter
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


    /** actions *******************************************************************************************************/

    public function actionCreate()
    {
        $this->type = $this->getParameter('t');
    }


    public function actionEdit()
    {
        $this->item = $this->addressItemRepository->get(['id' => $this->getId()]);
        $this->entity = $this->item->getAddress();
        $this->type = $this->getEntity()->getType();
    }


    public function actionDelete()
    {
        $this->item = $this->addressItemRepository->get(['id' => $this->getId()]);
        $this->entity = $this->item->getAddress();
        $this->type = $this->getEntity()->getType();
    }


    /** handles *******************************************************************************************************/

    public function handleDelete()
    {
        $this->addressItemRepository->remove(['id' => $this->getId()]);

        $this->flashMessage(_('Succesfully removed'), 'success');
        $this->getRedirect($this->entity);
    }


    /**
     * Create address from Google Map API
     */
    public function handleCreateAddressFromGoogleMapApi()
    {
        $address = $this->getParameter('address');

        $entity = $this->repository->createAddressFromGoogleMapApi($address);

        $addressEntity = $this->repository->create($entity);

        if ($this->isAjax()) {
            $this->payload->addressId = $addressEntity->getId();
            $this->sendPayload();
        } else {
            $this->flashMessage(_('Address is successfully created.'), 'success');
            $this->redirect('this');
        }
    }


    /** renders *******************************************************************************************************/

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
        $this->template->subTitle = $this->getEntity()->getFullAddress();
        $this->template->entity = $this->getEntity();
    }


    /** components ****************************************************************************************************/

    protected function createComponentForm()
    {
        return $this->context
            ->getService('AddressFormBuilder')
            ->setEntity($this->getEntity())
            ->build();
    }

}
