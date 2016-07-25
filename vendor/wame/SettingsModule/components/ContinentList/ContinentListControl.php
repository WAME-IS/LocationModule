<?php

namespace Wame\LocationModule\Vendor\Wame\SettingsModule\Components;

use Nette\DI\Container;
use Wame\Core\Components\BaseControl;
use Wame\LocationModule\Repositories\ContinentRepository;

interface IContinentListControlFactory
{

    /** @return ContinentListControl */
    public function create();
}

class ContinentListControl extends BaseControl
{

    /** @var ContinentRepository */
    private $continentRepository;

    public function __construct(
    Container $container, ContinentRepository $continentRepository
    )
    {
        parent::__construct($container);

        $this->continentRepository = $continentRepository;
    }

    public function render()
    {
        $this->template->continents = $this->continentRepository->find(['status !=' => ContinentRepository::STATUS_REMOVED]);
    }
}
