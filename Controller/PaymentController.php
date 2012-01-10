<?php

namespace Kitano\PaymentBundle\Controller;

use Kitano\PaymentBundle\PaymentSystem\SimpleCreditCardInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class PaymentController
    extends Controller
{
    public function paymentNotificationAction()
    {
        $paymentSystem = $this->get(
            $this->container->getParameter('kitano_payment.payment_system')
        );
        $paymentSystemProxy = $this->get("kitano_payment.payment_system_proxy");
        $paymentSystemProxy->setPaymentSystem($paymentSystem);
        $logger = $this->get('logger');
        $logger->debug(sprintf('Payment notification action with POST data : %s', print_r($this->getRequest()->request->all(), true)));

        return $paymentSystemProxy->handlePaymentNotification($this->getRequest());
    }

    public function backToShopAction()
    {
        $paymentSystem = $this->get(
            $this->container->getParameter('kitano_payment.payment_system')
        );
        $paymentSystemProxy = $this->get("kitano_payment.payment_system_proxy");
        $paymentSystemProxy->setPaymentSystem($paymentSystem);

        $logger = $this->get('logger');
        $logger->debug(sprintf('Payment notification action with POST data : %s', print_r($this->getRequest()->request->all(), true)));

        return $paymentSystemProxy->handleBackToShop($this->getRequest());
    }
}