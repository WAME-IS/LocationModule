<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Grids\Actions\Continent;

use Wame\AdminModule\Vendor\Wame\DataGridControl\Actions\EditModal as AdminEditModal;


class EditModal extends AdminEditModal
{
    public function __construct() 
    {
        $this->setLink(':Admin:Continent:edit');
    }
    
}