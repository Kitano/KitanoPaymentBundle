<?php

namespace Kitano\PaymentBundle\PaymentSystem;

use Kitano\PaymentBundle\Model\Transaction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface SimpleCreditCardInterface
{
    /**
     * @param  Transaction $transaction
     * @return void
     */
    public function authorizeAndCapture(Transaction $transaction);

    /**
     * @param  Request  $request
     * @return Response
     */
    public function handlePaymentNotification(Request $request);

    /**
     * @param  Transaction $transaction
     * @return string
     */
    public function renderLinkToPayment(Transaction $transaction);
}