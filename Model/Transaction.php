<?php

namespace Kitano\Bundle\PaymentBundle\Model;

use Symfony\Component\HttpFoundation\ParameterBag;

class Transaction
{
    const STATE_CANCELED = 1;
    const STATE_FAILED = 2;
    const STATE_EXPIRED = 3;
    const STATE_NEW = 4;
    const STATE_PENDING = 5;
    const STATE_SUCCESS = 6;
    const STATE_COMPLETE = 7;
    const STATE_APPROVED = 8;
    const STATE_APPROVING = 9;

    /* @var integer */
    private $id;

    /* @var string */
    protected $transactionId;

    /* @var string */
    protected $orderId;

    /* @var float */
    protected $amount = 0.0;

    /* @var string ISO 4217 */
    protected $currency;

    /* @var string */
    protected $date;

    /* @var string ISO 3166-1 alpha-2 */
    protected $country;

    /* @var ParameterBag */
    protected $extraData;

    /* @var integer */
    protected $state;

    /* @var string */
    protected $message;

    /* @var \DateTime */
    protected $createdAt;

    /* @var \DateTime */
    protected $updatedAt;


    public function __construct($orderId, $amount, \DateTime $date, $currency, $country)
    {
        $this->extraData = new ParameterBag();
        $this->setOrderId($orderId);
        $this->setAmount($amount);
        $this->setDate($date);
        $this->setCurrency($currency);
        $this->setCountry($country);
        $this->updatedAt = $this->createdAt = new \DateTime();
    }


    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param array $extraData
     */
    public function setExtraData(array $extraData)
    {
        $this->extraData = new ParameterBag($extraData);
    }

    /**
     * @return ParameterBag
     */
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param int $state
     */
    public function setState($state)
    {
        $this->state = (int) $state;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}