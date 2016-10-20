<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State\Containers;

use Nette\Utils\Strings;
use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Containers\BaseContainer;


interface ITitleContainerFactory extends IBaseContainer
{
    /** @return TitleContainer */
    public function create();
}


class TitleContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
    {
        $this->addText('title', _('Title'))
				->setRequired(_('Please enter title'));
    }


    /** {@inheritDoc} */
    public function setDefaultValues($entity, $langEntity = null)
    {
        $this['title']->setDefaultValue($langEntity->getTitle());
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getLangEntity()->setTitle($values['title']);
        $form->getLangEntity()->setSlug(Strings::webalize($values['title']));
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getLangEntity()->setTitle($values['title']);
        $form->getLangEntity()->setSlug(Strings::webalize($values['title']));
    }

}
