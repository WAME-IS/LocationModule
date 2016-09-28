<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Grids\Columns\State;

use Wame\DataGridControl\BaseGridItem;


class Currency extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addColumnText('currency', _('Currency'))
                ->setRenderer(function($state) {
                    return $state->getCurrency()->getSymbol();
                });
		
		return $grid;
	}
    
}