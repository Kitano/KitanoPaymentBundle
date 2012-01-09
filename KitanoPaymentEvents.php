<?php

namespace Kitano\PaymentBundle;

final class KitanoPaymentEvents
{
    const ON_PAYMENT_NOTIFICATION = 'kitano_payment.event.on_payment_notification';
    const AFTER_PAYMENT_NOTIFICATION = 'kitano_payment.event.after_payment_notification';

    const ON_AUTHORIZE_AND_CAPTURE = 'kitano_payment.event.on_authorize_and_capture';
    const AFTER_AUTHORIZE_AND_CAPTURE = 'kitano_payment.event.after_authorize_and_capture';

    const ON_CAPTURE = 'kitano_payment.event.on_capture';
    const AFTER_CAPTURE = 'kitano_payment.event.after_capture';

    const ON_AUTHORIZE = 'kitano_payment.event.on_authorize';
    const AFTER_AUTHORIZE = 'kitano_payment.event.after_authorize';

    const ON_RENDER_LINK = 'kitano_payment.event.on_render_link';
    const AFTER_RENDER_LINK = 'kitano_payment.event.after_render_link';
}