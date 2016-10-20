<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State\Containers;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Containers\BaseContainer;


interface ICodeContainerFactory extends IBaseContainer
{
    /** @return CodeContainer */
    public function create();
}


class CodeContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
    {
        $this->addText('code', _('Code'))
				->setRequired(_('Please enter code'))
				->addRule(Form::LENGTH, _('Must be %d characters'), 2);
    }


    /** {@inheritDoc} */
    public function setDefaultValues($entity, $langEntity = null)
    {
        $this['code']->setDefaultValue($entity->getCode());
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setCode($values['code']);
    }
    

    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setCode($values['code']);
    }

}
