<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Grids\ToolbarButtons;

use Wame\AdminModule\Vendor\Wame\DataGridControl\ToolbarButtons\Add as AdminAdd;


class AddState extends AdminAdd
{
    public function __construct() 
    {
        $this->setTitle(_('Add state'));
        $this->setLink(':Admin:State:create', ['id' => null]);
        $this->isAjaxModal(null, true);
    }

}