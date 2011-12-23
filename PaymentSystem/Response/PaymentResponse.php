<?php

namespace Kitano\PaymentBundle\PaymentSystem\Response;

class PaymentResponse
{
    const STATE_APPROVED = 1;
    const STATE_APPROVING = 2;
    const STATE_CANCELED = 3;
    const STATE_EXPIRED = 4;
    const STATE_FAILED = 5;
    const STATE_NEW = 6;
    const STATE_DEPOSITING = 7;
    const STATE_DEPOSITED = 8;

    /* @var integer */
    protected $code;

    /* @var string */
    protected $message;

    /* @var boolean */
    protected $valid = false;


    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param boolean $valid
     */
    public function setValid($valid)
    {
        $this->valid = (bool) $valid;
    }

    /**
     * @return boolean
     */
    public function getValid()
    {
        return $this->valid;
    }
}