<?php

namespace Kitano\PaymentBundle\Model;

class Transaction
{
    const STATE_REFUSED = "refused";
    const STATE_BANK_BAN = "bank_ban";
    const STATE_FILTERED = "filtered";
    const STATE_NEW = "new";
    const STATE_APPROVED = "approved";
    const STATE_FAILED = "failed";
    const STATE_INVALID_FORMAT = "invalid_format";
    const STATE_SERVER_ERROR = "server_error";
    const STATE_CANCELED_BY_USER = "canceled_by_user";

    /* @var integer */
    private $id;

    /* @var string */
    protected $transactionId = null;

    /* @var string */
    protected $orderId = null;

    /* @var float */
    protected $amount = 0.0;

    /* @var string ISO 4217 */
    protected $currency;

    /* @var \DateTime */
    protected $stateDate;

    /* @var string ISO 3166-1 alpha-2 */
    protected $country;

    /* @var array */
    protected $extraData;

    /* @var string */
    protected $state;

    /* @var string */
    protected $message;

    /* @var \DateTime */
    protected $createdAt;

    /* @var \DateTime */
    protected $updatedAt;

    /* @var boolean */
    protected $success = false;

    /* @var string */
    protected $locale = null;

    public function __construct($orderId, $amount, \DateTime $date, $currency, $country, $locale = null)
    {
        $this->setOrderId($orderId);
        $this->setAmount($amount);
        $this->setStateDate($date);
        $this->setCurrency($currency);
        $this->setCountry($country);
        $this->setLocale($locale);
        $this->updatedAt = $this->createdAt = new \DateTime();
        $this->setState(self::STATE_NEW);
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
     * @param \DateTime $stateDate
     */
    public function setStateDate(\DateTime $stateDate)
    {
        $this->stateDate = $stateDate;
    }

    /**
     * @return \DateTime
     */
    public function getStateDate()
    {
        return $this->stateDate;
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
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
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
        $this->extraData = $extraData;
    }

    /**
     * @return array
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
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
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

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = (bool) $success;
    }

    /**
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->getSuccess();
    }
}