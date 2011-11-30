<?php

namespace Kitano\Bundle\PaymentBundle;

final class KitanoPaymentEvents
{
    const PAYMENT_NOTIFICATION = 'kitano_payment.event.payment_notification';
    const PAYMENT_CAPTURE = 'kitano_payment.event.payment_capture';
}