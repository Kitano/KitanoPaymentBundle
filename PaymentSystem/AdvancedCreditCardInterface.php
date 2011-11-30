<?php

namespace Kitano\Bundle\PaymentBundle\PaymentSystem;

use Kitano\Bundle\PaymentBundle\Model\AuthorizationTransaction;
use Kitano\Bundle\PaymentBundle\Model\Transaction;

interface AdvancedCreditCardInterface extends CreditCardInterface
{
    /**
     * @param  AuthorizationTransaction $transaction
     * @return void
     */
    public function authorize(AuthorizationTransaction $transaction);
}