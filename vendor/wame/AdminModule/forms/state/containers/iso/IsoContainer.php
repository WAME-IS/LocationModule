<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State\Containers;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Containers\BaseContainer;


interface IIsoContainerFactory extends IBaseContainer
{
    /** @return IsoContainer */
    public function create();
}


class IsoContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
    {
        $this->addText('iso', _('ISO shortcut'))
				->setRequired(_('Please enter iso shortcut'))
				->addRule(Form::LENGTH, _('Must be %d characters'), 3);
    }


    /** {@inheritDoc} */
    public function setDefaultValues($entity, $langEntity = null)
    {
        $this['iso']->setDefaultValue($entity->getIso());
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setIso($values['iso']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setIso($values['iso']);
    }

}
