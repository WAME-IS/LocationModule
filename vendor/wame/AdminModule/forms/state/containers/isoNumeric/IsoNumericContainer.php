<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State\Containers;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Containers\BaseContainer;


interface IIsoNumericContainerFactory extends IBaseContainer
{
    /** @return IsoNumericContainer */
    public function create();
}


class IsoNumericContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
    {
        $this->addText('isoNumeric', _('ISO numeric code'))
				->addRule(Form::INTEGER, _('Must be a number'), '.*[0-9].*');
    }


    /** {@inheritDoc} */
    public function setDefaultValues($entity, $langEntity = null)
    {
        $this['isoNumeric']->setDefaultValue($entity->getIsoNumeric());
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setIsoNumeric($values['isoNumeric']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setIsoNumeric($values['isoNumeric']);
    }

}
