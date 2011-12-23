<?php

namespace Kitano\PaymentBundle\Controller;

use Kitano\PaymentBundle\PaymentSystem\SimpleCreditCardInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class PaymentNotificationController
    extends Controller
{
    public function __construct()
    {
    }

    public function paymentNotificationAction()
    {
        $paymentSystem = $this->get(
            $this->container->getParameter('kitano_payment.payment_system')
        );
        $logger = $this->get('logger');
        $logger->debug(sprintf('Payment notification action with POST data : %s', print_r($this->getRequest()->request->all(), true)));

        return $paymentSystem->handlePaymentNotification($this->getRequest());
    }
}