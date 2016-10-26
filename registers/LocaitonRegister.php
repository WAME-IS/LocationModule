<?php

namespace Wame\LocationModule\Registers;

use Wame\Core\Registers\BaseRegister;

class LocationRegister extends BaseRegister
{
    public function __construct()
    {
        parent::__construct(Types\LocationType::class);
    }
    
}
