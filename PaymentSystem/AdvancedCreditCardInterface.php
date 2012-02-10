<?php

namespace Kitano\PaymentBundle\PaymentSystem;

use Kitano\PaymentBundle\Entity\AuthorizationTransaction;
use Kitano\PaymentBundle\Entity\Transaction;

interface AdvancedCreditCardInterface extends CreditCardInterface
{
    /**
     * @param  AuthorizationTransaction $transaction
     * @return void
     */
    public function authorize(AuthorizationTransaction $transaction);
}