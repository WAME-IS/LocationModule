<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Grids\Columns\State;

use Wame\DataGridControl\BaseGridItem;


class PhonePrefix extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addColumnText('phone_prefix', _('Phone prefix'));
		
		return $grid;
	}
    
}