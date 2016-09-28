<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Grids\Columns\State;

use Wame\DataGridControl\BaseGridItem;


class Tld extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addColumnText('tld', _('Web domain'));
		
		return $grid;
	}
    
}