<?php

namespace Wame\LocationModule\Registers\Types;

abstract class LocationType
{
    /**
     * Get alias
     */
	abstract function getAlias();
	
    /**
     * Get name
     */
	abstract function getName();
	
    /**
     * Get class name
     */
	abstract function getClassName();
	
}