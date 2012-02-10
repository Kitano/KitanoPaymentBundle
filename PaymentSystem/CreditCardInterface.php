<?php

namespace Kitano\PaymentBundle\PaymentSystem;

use Kitano\PaymentBundle\Entity\CaptureTransaction;

interface CreditCardInterface extends SimpleCreditCardInterface
{
    /**
     * @param  CaptureTransaction $transaction
     * @return void
     */
    public function capture(CaptureTransaction $transaction);
}