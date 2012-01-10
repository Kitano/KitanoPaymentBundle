<?php

namespace Kitano\PaymentBundle\PaymentSystem;

use Kitano\PaymentBundle\Model\Transaction;
use Kitano\PaymentBundle\PaymentSystem\HandlePaymentResponse;

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
     * @return HandlePaymentResponse
     */
    public function handlePaymentNotification(Request $request);

    /**
     * @param  Request  $request
     * @return HandlePaymentResponse (a redirect to a page ok or ko)
     */
    public function handleBackToShop(Request $request);

    /**
     * @param  Transaction $transaction
     * @return string
     */
    public function renderLinkToPayment(Transaction $transaction);
}