<?php

namespace Kitano\Bundle\PaymentBundle\PaymentSystem;

use Kitano\Bundle\PaymentBundle\Model\CaptureTransaction;

interface CreditCardInterface extends SimpleCreditCardInterface
{
    /**
     * @param  CaptureTransaction $transaction
     * @return void
     */
    public function capture(CaptureTransaction $transaction);
}