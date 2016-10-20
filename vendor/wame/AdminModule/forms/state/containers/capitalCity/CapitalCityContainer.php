<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State\Containers;

use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Containers\BaseContainer;


interface ICapitalCityContainerFactory extends IBaseContainer
{
    /** @return CapitalCityContainer */
    public function create();
}


class CapitalCityContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
    {
        $this->addText('capitalCity', _('Capital city'))
                ->setRequired(_('Please enter capital city'));
    }


    /** {@inheritDoc} */
    public function setDefaultValues($entity, $langEntity = null)
    {
        $this['capitalCity']->setDefaultValue($langEntity->getCapitalCity());
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getLangEntity()->setCapitalCity($values['capitalCity']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getLangEntity()->setCapitalCity($values['capitalCity']);
    }

}
