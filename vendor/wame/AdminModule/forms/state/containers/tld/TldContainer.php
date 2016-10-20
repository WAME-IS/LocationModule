<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State\Containers;

use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Containers\BaseContainer;


interface ITldContainerFactory extends IBaseContainer
{
    /** @return TldContainer */
    public function create();
}


class TldContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
    {
        $this->addText('tld', _('National web domain'));
    }


    /** {@inheritDoc} */
    public function setDefaultValues($entity, $langEntity = null)
    {
        $this['tld']->setDefaultValue($entity->getTld());
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setTld($values['tld']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setTld($values['tld']);
    }

}
