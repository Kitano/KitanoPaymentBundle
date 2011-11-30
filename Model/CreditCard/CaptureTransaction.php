<?php

namespace Kitano\Bundle\PaymentBundle\Model\CreditCard;

use Kitano\Bundle\PaymentBundle\Model\Transaction;

class CaptureTransaction extends Transaction
{
    /* @var Transaction */
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
     * @param Transaction $baseTransaction
     */
    public function setBaseTransaction(Transaction $baseTransaction)
    {
        $this->baseTransaction = $baseTransaction;
    }

    /**
     * @return Transaction
     */
    public function getBaseTransaction()
    {
        return $this->baseTransaction;
    }
}