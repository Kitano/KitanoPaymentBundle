<?php

namespace Kitano\PaymentBundle\PaymentSystem;

use Kitano\PaymentBundle\Model\CaptureTransaction;

interface CreditCardInterface extends SimpleCreditCardInterface
{
    /**
     * @param  CaptureTransaction $transaction
     * @return void
     */
    public function capture(CaptureTransaction $transaction);
}