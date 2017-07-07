<?php

namespace Wame\LocationModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;


interface IHouseNumberContainerFactory extends IBaseContainer
{
	/** @return HouseNumberContainer */
	public function create();
}


class HouseNumberContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
	{
		$this->addText('houseNumber', _('House number'));
    }


    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['houseNumber']->setDefaultValue($entity->getHouseNumber());
	}


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setHouseNumber($values['houseNumber']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setHouseNumber($values['houseNumber']);
    }

}
