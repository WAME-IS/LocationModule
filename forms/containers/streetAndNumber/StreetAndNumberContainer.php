<?php

namespace Wame\LocationModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;


interface IStreetAndNumberContainerFactory extends IBaseContainer
{
	/** @return StreetAndNumberContainer */
	public function create();
}


class StreetAndNumberContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
	{
		$this->addText('street', _('Street / House number'));
    }


    /** {@inheritDoc} */
	public function setDefaultValues($entity)
	{
        $this['street']->setDefaultValue($entity->getStreet());
	}


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setStreet($values['street']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setStreet($values['street']);
    }

}
