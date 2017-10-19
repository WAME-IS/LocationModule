<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\Columns;
use Wame\LocationModule\Entities\Columns\Address;


/**
 * @ORM\Table(name="wame_address_item")
 * @ORM\Entity
 */
class AddressItemEntity extends \Wame\Core\Entities\BaseEntity
{
	use Columns\Identifier;
	use Columns\Type;
	use Columns\ValueId;
	use Address;

}
