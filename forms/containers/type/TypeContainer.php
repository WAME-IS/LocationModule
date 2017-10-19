<?php

namespace Wame\LocationModule\Forms\Containers;

use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\DynamicObject\Registers\Types\IBaseContainer;


interface ITypeContainerFactory extends IBaseContainer
{
	/** @return TypeContainer */
	public function create();
}


class TypeContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
	{
		$this->addHidden('type');
    }


	public function render()
    {
        $this['type']->setDefaultValue($this->getPresenter()->type);

        parent::render();
    }

}
