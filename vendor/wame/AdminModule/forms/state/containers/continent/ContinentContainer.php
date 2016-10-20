<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State\Containers;

use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\LocationModule\Repositories\ContinentRepository;


interface IContinentContainerFactory extends IBaseContainer
{
    /** @return ContinentContainer */
    public function create();
}


class ContinentContainer extends BaseContainer
{
    /** @var ContinentRepository */
    private $continentRepository;

    /** @var array */
    private $continentList;


   	public function __construct(
		ContinentRepository $continentRepository
	) {
		parent::__construct();

		$this->continentRepository = $continentRepository;
		$this->continentList = $continentRepository->getContinentList();
	}


    /** {@inheritDoc} */
    public function configure()
    {
        $this->addSelect('continent', _('Continent'), $this->continentList)
				->setPrompt('- ' . _('Select continent') . ' -')
				->setRequired(_('Please select continent'));
    }


    /** {@inheritDoc} */
    public function setDefaultValues($entity, $langEntity = null)
    {
        $this['continent']->setDefaultValue($entity->getContinent()->getId());
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $continentEntity = $this->continentRepository->get(['id' => $values['continent']]);

        $form->getEntity()->setContinent($continentEntity);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $continentEntity = $this->continentRepository->get(['id' => $values['continent']]);

        $form->getEntity()->setContinent($continentEntity);
    }

}
