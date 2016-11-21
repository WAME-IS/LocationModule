<?php

namespace Wame\LocationModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Nette\Utils\Strings;
use Wame\Core\Entities\Columns;
use Wame\LanguageModule\Entities\TranslatableEntity;
use Wame\CurrencyModule\Entities\Columns\Currency;

/**
 * @ORM\Table(name="wame_state")
 * @ORM\Entity
 */
class StateEntity extends TranslatableEntity
{

    use Columns\Identifier;
    use Columns\EditDate;
    use Columns\EditUser;
    use Columns\Status;
    use Columns\Token;
    use Currency;

    /**
     * @ORM\ManyToOne(targetEntity="ContinentEntity", cascade={"persist"})
     * @ORM\JoinColumn(name="continent_id", referencedColumnName="id", nullable=false)
     */
    protected $continent;

    /**
     * @ORM\OneToMany(targetEntity="StateLangEntity", mappedBy="state", cascade={"persist"})
     */
    protected $langs;

    /**
     * @ORM\Column(name="code", type="string", length=2, nullable=false)
     */
    protected $code;

    /**
     * @ORM\Column(name="iso", type="string", length=3, nullable=false)
     */
    protected $iso;

    /**
     * @ORM\Column(name="iso_numeric", type="integer", nullable=false)
     */
    protected $isoNumeric;

    /**
     * @ORM\Column(name="phone_prefix", type="string", length=10, nullable=false)
     */
    protected $phonePrefix;

    /**
     * @ORM\Column(name="tld", type="string", length=10, nullable=false)
     */
    protected $tld;

    /** get *********************************************************** */
    public function getContinent()
    {
        return $this->continent;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getIso()
    {
        return $this->iso;
    }

    public function getIsoNumeric()
    {
        return $this->isoNumeric;
    }

    public function getPhonePrefix()
    {
        return $this->phonePrefix;
    }

    public function getTld()
    {
        return $this->tld;
    }

    /** set *********************************************************** */
    public function setContinent($continent)
    {
        $this->continent = $continent;

        return $this;
    }

    public function setCode($code)
    {
        $this->code = Strings::lower($code);

        return $this;
    }

    public function setIso($iso)
    {
        $this->iso = Strings::lower($iso);

        return $this;
    }

    public function setIsoNumeric($isoNumeric)
    {
        $this->isoNumeric = $isoNumeric;

        return $this;
    }

    public function setPhonePrefix($phonePrefix)
    {
        $this->phonePrefix = $phonePrefix;

        return $this;
    }

    public function setTld($tld)
    {
        $this->tld = Strings::lower($tld);

        return $this;
    }
}
