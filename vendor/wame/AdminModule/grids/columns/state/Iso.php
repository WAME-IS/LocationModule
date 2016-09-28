<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Grids\Columns\State;

use Wame\DataGridControl\BaseGridItem;


class Iso extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addColumnText('iso', _('ISO shortcut'));
		
		return $grid;
	}
    
}