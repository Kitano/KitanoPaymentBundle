<?php

namespace Kitano\Bundle\PaymentBundle\Model\CreditCard;

class CreditCard
{
    /* @var string  Credit card type : Visa, Mastercard, Maestro, etc... */
    protected $type;

    /* @var string */
    protected $number;

    /* @var string */
    protected $cvv;

    /* @var string Year 4 digits */
    protected $expireYear;

    /* @var string Month 2 digits */
    protected $expireMonth;


    /**
     * @param string $type
     * @param string $number
     * @param string $expireMonth
     * @param string $expireYear
     */
    public function __construct($type, $number, $expireMonth, $expireYear)
    {
        $this->setType($type);
        $this->setNumber($number);
        $this->setExpireMonth($expireMonth);
        $this->setExpireYear($expireYear);
    }

    /**
     * @param string $cvv
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    /**
     * @return string
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param string $expireMonth
     */
    public function setExpireMonth($expireMonth)
    {
        $this->expireMonth = $expireMonth;
    }

    /**
     * @return string
     */
    public function getExpireMonth()
    {
        return $this->expireMonth;
    }

    /**
     * @param string $expireYear
     */
    public function setExpireYear($expireYear)
    {
        $this->expireYear = $expireYear;
    }

    /**
     * @return string
     */
    public function getExpireYear()
    {
        return $this->expireYear;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}