<?php

namespace Kitano\PaymentBundle\PaymentSystem;

use Kitano\PaymentBundle\Model\AuthorizationTransaction;
use Kitano\PaymentBundle\Model\Transaction;

interface AdvancedCreditCardInterface extends CreditCardInterface
{
    /**
     * @param  AuthorizationTransaction $transaction
     * @return void
     */
    public function authorize(AuthorizationTransaction $transaction);
}