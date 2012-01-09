<?php

namespace Kitano\PaymentBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Kitano\PaymentBundle\Model\Transaction;

class PaymentSystemConfigEvent extends Event
{
    /* @var Transaction */
    protected $transaction;

    /**
     * Constructor
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @param Transaction $transaction
     */
    public function setTransaction(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @return Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}
