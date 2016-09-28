<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Grids\Actions\State;

use Wame\AdminModule\Vendor\Wame\DataGridControl\Actions\Delete as AdminDelete;


class Delete extends AdminDelete
{
    public function __construct() 
    {
        $this->setLink(':Admin:State:delete');
    }
    
}