<?php

namespace Kitano\Bundle\PaymentBundle\Model\CreditCard;

use Kitano\Bundle\PaymentBundle\Model\Transaction;

class CaptureTransaction extends Transaction
{
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