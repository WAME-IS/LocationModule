<?php

namespace Wame\LocationModule\Components;

use Wame\Core\Components\BaseControl;
use Wame\Core\Registers\RepositoryRegister;
use Wame\Core\Registers\StatusTypeRegister;
use Wame\Core\Traits\TRegister;
use Wame\LocationModule\Entities\AddressEntity;
use Wame\LocationModule\Repositories\AddressItemRepository;


interface IAddressListControlFactory
{
	/** @return AddressListControl */
	public function create();
}


class AddressListControl extends BaseControl
{
    /** @var AddressItemRepository */
    private $addressItemtRepository;


    public function __construct(
        \Nette\DI\Container $container,
        AddressItemRepository $addressItemtRepository
    ) {
        parent::__construct($container);

        $this->addressItemtRepository = $addressItemtRepository;
    }


    public function handleSetMain()
    {
        $this->addressItemtRepository->setMain($this->getParameter('id'));

        $this->getPresenter()->flashMessage(_('The address was set as the main'), 'success');
        $this->getPresenter()->redirect('this');
    }


	public function render()
	{
	    $entity = $this->getPresenter()->getEntity();
        $type = $this->statusTypeRegister->getByEntityClass(get_class($entity))->getAlias();
	    $value = $this->getPresenter()->getId();

		$this->template->list = $this->addressItemtRepository->find(['type' => $type, 'valueId' => $value]);
        $this->template->type = $type;
        $this->template->value = $value;
        $this->template->module = $this->getPresenter()->getModule(null, false);
        $this->template->main = $this->addressItemtRepository->getMain($type, $value);
	}

}
