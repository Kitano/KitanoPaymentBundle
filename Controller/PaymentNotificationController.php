<?php

namespace Kitano\Bundle\PaymentBundle\Controller;

use Kitano\Bundle\PaymentBundle\PaymentSystem\SimpleCreditCardInterface;
use Symfony\Component\HttpFoundation\Request;

class PaymentNotificationController
{
    /* @var SimpleCreditCardInterface */
    protected $creditCardSystem;

    /* @var Request */
    protected $request;


    public function __construct(SimpleCreditCardInterface $creditCardSystem, Request $request)
    {
        $this->creditCardSystem = $creditCardSystem;
        $this->request = $request;
    }

    public function paymentNotificationAction()
    {
        return $this->creditCardSystem->handlePaymentNotification($this->request);
    }
}