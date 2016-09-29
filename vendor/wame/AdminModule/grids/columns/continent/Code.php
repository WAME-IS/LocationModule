<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Grids\Columns\Continent;

use Wame\DataGridControl\BaseGridItem;


class Code extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addColumnText('code', _('Code'));
		
		return $grid;
	}
    
}