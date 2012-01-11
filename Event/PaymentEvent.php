<?php

namespace Kitano\PaymentBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use Kitano\PaymentBundle\Event\AbstractEvent;
use Kitano\PaymentBundle\Model\Transaction;
use Kitano\PaymentBundle\PaymentSystem\SimpleCreditCardInterface;

class PaymentEvent extends AbstractEvent
{
    /* @var Transaction */
    protected $transaction = null;

    /* @var SimpleCreditCardInterface */
    protected $paymentSystem = null;

    /**
     * @param null|Transaction $transaction
     */
    public function setTransaction($transaction)
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

    /**
     * @param SimpleCreditCardInterface $paymentSystem
     */
    public function setPaymentSystem(SimpleCreditCardInterface $paymentSystem)
    {
        $this->paymentSystem = $paymentSystem;
    }

    /**
     * @return SimpleCreditCardInterface
     */
    public function getPaymentSystem()
    {
        return $this->paymentSystem;
    }
}
