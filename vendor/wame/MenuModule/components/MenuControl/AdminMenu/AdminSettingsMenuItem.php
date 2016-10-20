<?php

namespace Wame\LocationModule\Vendor\Wame\MenuModule\Components\MenuControl\AdminMenu;

use Nette\Application\LinkGenerator;
use Wame\MenuModule\Models\Item;

interface IAdminSettingsMenuItem
{
	/** @return AdminSettingsMenuItem */
	public function create();
}


class AdminSettingsMenuItem implements \Wame\MenuModule\Models\IMenuItem
{
    /** @var LinkGenerator */
	private $linkGenerator;


	public function __construct(
		LinkGenerator $linkGenerator
	) {
		$this->linkGenerator = $linkGenerator;
	}


	public function addItem()
	{
		$item = new Item();
		$item->setName('settings');

        $item->addNode($this->settingsStates(), 'states');
        $item->addNode($this->settingsContinents(), 'continents');

		return $item->getItem();
	}


    private function settingsStates()
    {
        $item = new Item();
        $item->setName('settings-states');
        $item->setTitle(_('States'));
        $item->setLink($this->linkGenerator->link('Admin:State:', ['id' => null]));

        return $item->getItem();
    }

    private function settingsContinents()
    {
        $item = new Item();
        $item->setName('settings-continents');
        $item->setTitle(_('Continents'));
        $item->setLink($this->linkGenerator->link('Admin:Continent:', ['id' => null]));

        return $item->getItem();
    }

}
