<?php

namespace Kitano\PaymentBundle\Controller;

use Kitano\PaymentBundle\PaymentSystem\SimpleCreditCardInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

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
        $this->log(sprintf('Payment notification action with POST data : %s', print_r($this->request->request->all(), true)));

        return $this->creditCardSystem->handlePaymentNotification($this->request);
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $message
     */
    public function log($message)
    {
        if (null !== $this->logger) {
            $this->logger->debug($message);
        }
    }
}