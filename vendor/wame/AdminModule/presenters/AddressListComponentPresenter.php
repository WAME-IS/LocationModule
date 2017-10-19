<?php

namespace App\AdminModule\Presenters;

use Wame\Core\Presenters\Traits\UseParentTemplates;
use Wame\Core\Forms\IStatusTypeFormContainerFactory;


class AddressListComponentPresenter extends AbstractComponentPresenter
{
    use UseParentTemplates;


    /** {@inheritDoc} */
    protected function getComponentIdentifier()
    {
        return 'AddressListComponent';
    }


    /** {@inheritDoc} */
    protected function getComponentName()
    {
        return _('Address list');
    }

}
