<?php

namespace Kitano\PaymentBundle\Entity;

use Kitano\PaymentBundle\Entity\Transaction;

class CaptureTransaction extends Transaction
{
    const STATE_UNKNOWN_ORDER = 401;
    const STATE_EXPIRED = 402;
    const STATE_ATTEMPT_LIMIT_REACHED = 403;
    const STATE_ALREADY_APPROVED = 404;
    const STATE_APPROVING = 301;
    const STATE_BUSY = 302;

    /* @var AuthorizationTransaction */
    protected $baseTransaction;

    /**
     * @return float
     */
    public function getRemainingAmount()
    {
        $remainingAmount = (float) ($this->getBaseTransaction()->getAmount() - $this->getAmount());

        return $remainingAmount;
    }

    /**
     * @param AuthorizationTransaction $baseTransaction
     */
    public function setBaseTransaction(AuthorizationTransaction $baseTransaction)
    {
        $this->baseTransaction = $baseTransaction;
    }

    /**
     * @return AuthorizationTransaction
     */
    public function getBaseTransaction()
    {
        return $this->baseTransaction;
    }
}