<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Grids\Columns\State;

use Wame\DataGridControl\BaseGridItem;


class Continent extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addColumnText('continent', _('Continent'))
                ->setRenderer(function($state) {
                    return $state->getContinent()->getTitle();
                });
		
		return $grid;
	}
    
}