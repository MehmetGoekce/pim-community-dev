<?php

namespace Akeneo\Channel\Component\Model;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Currency entity
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 * @UniqueEntity("code")
 */
class Currency implements CurrencyInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var bool
     */
    protected $activated;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activated = true;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return Currency
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isActivated()
    {
        return $this->activated;
    }

    /**
     * {@inheritdoc}
     */
    public function toggleActivation()
    {
        $this->activated = !$this->activated;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReference()
    {
        return $this->code;
    }
}