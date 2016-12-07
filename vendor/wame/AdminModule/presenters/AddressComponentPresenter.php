<?php

namespace App\AdminModule\Presenters;

use Wame\Core\Presenters\Traits\UseParentTemplates;
use Wame\Core\Forms\IStatusTypeFormContainerFactory;


class AddressComponentPresenter extends AbstractComponentPresenter
{
    use UseParentTemplates;


    /** @var IStatusTypeFormContainerFactory @inject */
	public $IStatusTypeFormContainerFactory;


    /** {@inheritDoc} */
    protected function getComponentIdentifier()
    {
        return 'AddressComponent';
    }


    /** {@inheritDoc} */
    protected function getComponentName()
    {
        return _('Address');
    }


    /** {@inheritDoc} */
	protected function createComponentForm()
	{
		$form = $this->componentForm
						->setType('AddressComponent')
						->setId($this->id)
                        ->addFormContainer($this->IStatusTypeFormContainerFactory->create(), 'StatusTypeFormContainer', 85)
						->build();

		return $form;
	}

}
