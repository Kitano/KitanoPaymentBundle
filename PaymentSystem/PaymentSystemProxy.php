<?php
namespace Kitano\PaymentBundle\PaymentSystem;

use Kitano\PaymentBundle\Model\Transaction;
use Kitano\PaymentBundle\Event\PaymentEvent;
use Kitano\PaymentBundle\KitanoPaymentEvents;
use Kitano\PaymentBundle\PaymentSystem\SimpleCreditCardInterface;
use Kitano\PaymentBundle\PaymentSystem\AdvancedCreditCardInterface;
use Kitano\PaymentBundle\Model\AuthorizationTransaction;
use Kitano\PaymentBundle\Model\CaptureTransaction;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * proxy that insert events when functions of the payment system are called.
 */
class PaymentSystemProxy
    implements AdvancedCreditCardInterface
{
    /** @var null|\Symfony\Component\EventDispatcher\EventDispatcherInterface */
    protected $dispatcher = null;

    /** @var \Kitano\PaymentBundle\PaymentSystem\SimpleCreditCardInterface|null */
    protected $freePaymentSystem = null;

    /**
     * constructor
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        EventDispatcherInterface $dispatcher,
        SimpleCreditCardInterface $freePaymentSystem
    )
    {
        $this->dispatcher = $dispatcher;
        $this->freePaymentSystem = $freePaymentSystem;
    }
    /**
     * @var SimpleCreditCardInterface
     */
    protected $paymentSystem = null;
    /**
     * @param SimpleCreditCardInterface $paymentSystem
     */
    public function setPaymentSystem(SimpleCreditCardInterface $paymentSystem)
    {
        $this->paymentSystem = $paymentSystem;
    }

    /**
     * @return \SimpleCreditCardInterface
     */
    public function getPaymentSystem()
    {
        return $this->paymentSystem;
    }

    /**
     * @param  Transaction $transaction
     * @return void
     */
    public function authorizeAndCapture(Transaction $transaction)
    {
        $event = new PaymentEvent();
        $event->setTransaction($transaction);
        $event->setPaymentSystem($this->paymentSystem);
        $this->dispatcher->dispatch(KitanoPaymentEvents::ON_AUTHORIZE_AND_CAPTURE, $event);

        if (! $event->isDefaultPrevented()) {
            $this->paymentSystem->authorizeAndCapture($transaction);
        }
        $this->dispatcher->dispatch(KitanoPaymentEvents::AFTER_AUTHORIZE_AND_CAPTURE, $event);
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function handlePaymentNotification(Request $request)
    {
        $event = new PaymentEvent();
        $event->set("request", $request);
        $event->setPaymentSystem($this->paymentSystem);
        $this->dispatcher->dispatch(KitanoPaymentEvents::ON_PAYMENT_NOTIFICATION, $event);

        if (! $event->isDefaultPrevented()) {
            $handleResponse = $this->paymentSystem->handlePaymentNotification($request);
            $event->setTransaction($handleResponse->getTransaction());
            $event->set("response", $handleResponse->getResponse());
        }

        $this->dispatcher->dispatch(KitanoPaymentEvents::AFTER_PAYMENT_NOTIFICATION, $event);
        return $event->get("response");
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function handleBackToShop(Request $request)
    {
        $event = new PaymentEvent();
        $event->set("request", $request);
        $event->setPaymentSystem($this->paymentSystem);
        $this->dispatcher->dispatch(KitanoPaymentEvents::ON_BACK_TO_SHOP, $event);

        if (! $event->isDefaultPrevented()) {
            if ($request->request->get('transactionType', null) == "free") {
                $handleResponse = $this->freePaymentSystem->handleBackToShop($request);
            } else {
                $handleResponse = $this->paymentSystem->handleBackToShop($request);
            }
            $event->setTransaction($handleResponse->getTransaction());
            $event->set("response", $handleResponse->getResponse());
        }

        $this->dispatcher->dispatch(KitanoPaymentEvents::AFTER_BACK_TO_SHOP, $event);
        return $event->get("response");
    }

    /**
     * @param  Transaction $transaction
     * @return string
     */
    public function renderLinkToPayment(Transaction $transaction)
    {
        $event = new PaymentEvent();
        $event->setTransaction($transaction);
        $event->setPaymentSystem($this->paymentSystem);
        $this->dispatcher->dispatch(KitanoPaymentEvents::ON_RENDER_LINK, $event);

        if (! $event->isDefaultPrevented()) {
            if (round($transaction->getAmount(), 2) == 0) {
                $html = $this->freePaymentSystem->renderLinkToPayment($transaction);
            } else {
                $html = $this->paymentSystem->renderLinkToPayment($transaction);
            }
            $event->set("html", $html);
        }
        $this->dispatcher->dispatch(KitanoPaymentEvents::ON_RENDER_LINK, $event);
        return $event->get("html");
    }

    /**
     * @param  CaptureTransaction $transaction
     * @return void
     */
    public function capture(CaptureTransaction $transaction)
    {
        $event = new PaymentEvent();
        $event->setTransaction($transaction);
        $event->setPaymentSystem($this->paymentSystem);
        $this->dispatcher->dispatch(KitanoPaymentEvents::ON_CAPTURE, $event);

        if (! $event->isDefaultPrevented()) {
            $this->paymentSystem->capture($transaction);
        }
        $this->dispatcher->dispatch(KitanoPaymentEvents::AFTER_CAPTURE, $event);
    }

    /**
     * @param  AuthorizationTransaction $transaction
     * @return void
     */
    public function authorize(AuthorizationTransaction $transaction)
    {
        $event = new PaymentEvent();
        $event->setTransaction($transaction);
        $event->setPaymentSystem($this->paymentSystem);
        $this->dispatcher->dispatch(KitanoPaymentEvents::ON_AUTHORIZE, $event);

        if (! $event->isDefaultPrevented()) {
            $this->paymentSystem->authorize($transaction);
        }
        $this->dispatcher->dispatch(KitanoPaymentEvents::AFTER_AUTHORIZE, $event);
    }


}
