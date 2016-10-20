<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State\Containers;

use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Containers\BaseContainer;


interface IPhonePrefixContainerFactory extends IBaseContainer
{
    /** @return PhonePrefixContainer */
    public function create();
}


class PhonePrefixContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
    {
        $this->addText('phonePrefix', _('Phone prefix'))
                ->setRequired(_('Please enter phone prefix'));
    }


    /** {@inheritDoc} */
    public function setDefaultValues($entity, $langEntity = null)
    {
        $this['phonePrefix']->setDefaultValue($entity->getPhonePrefix());
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setPhonePrefix($values['phonePrefix']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setPhonePrefix($values['phonePrefix']);
    }

}
