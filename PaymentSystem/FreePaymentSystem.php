<?php

namespace Kitano\PaymentBundle\PaymentSystem;

use Kitano\PaymentBundle\PaymentSystem\SimpleCreditCardInterface;
use Kitano\PaymentBundle\Model\Transaction;
use Kitano\PaymentBundle\Model\AuthorizationTransaction;
use Kitano\PaymentBundle\KitanoPaymentEvents;
use Kitano\PaymentBundle\Repository\TransactionRepositoryInterface;
use Kitano\PaymentBundle\PaymentException;
use Kitano\PaymentBundle\PaymentSystem\HandlePaymentResponse;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Templating\EngineInterface;

class FreePaymentSystem
    implements SimpleCreditCardInterface
{
    /* @var TransactionRepositoryInterface */
    protected $transactionRepository;

    /** @var null|LoggerInterface */
    protected $logger = null;

    /* @var EngineInterface */
    protected $templating;

    /** @var null| string */
    protected $internalBackToShopUrl = null;

    /** @var null| string */
    protected $externalBackToShopUrl = null;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        LoggerInterface $logger,
        EngineInterface $templating,
        $internalBackToShopUrl,
        $externalBackToShopUrl
    )
    {
        $this->transactionRepository = $transactionRepository;
        $this->logger = $logger;
        $this->templating = $templating;

        $this->internalBackToShopUrl = $internalBackToShopUrl;
        $this->externalBackToShopUrl = $externalBackToShopUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function renderLinkToPayment(Transaction $transaction)
    {
        return $this->templating->render('KitanoPaymentBundle:PaymentSystem:freeOrderLinkToPayment.html.twig', array(
            'orderId' => $transaction->getOrderId(),
            'transactionId' => $transaction->getId(),
            'transactionType' => 'free',
            'internalBackToShop' => $this->internalBackToShopUrl,
            'externalBackToShop' => $this->externalBackToShopUrl
        ));
    }


    /**
     * {@inheritDoc}
     */
    public function authorizeAndCapture(Transaction $transaction)
    {
        // Nothing to do
    }


    /**
     * {@inheritDoc}
     */
    public function handleBackToShop(Request $request)
    {
        $requestData = $request->request;
        $transaction = $this->transactionRepository->find($requestData->get('transactionId', null));
        if (round($transaction->getAmount(), 2) != 0) {
            throw new PaymentException("Amount is not null in freePaymentSystem, strange");
        }
        $transaction->setState(AuthorizationTransaction::STATE_APPROVED);
        $transaction->setSuccess(true);
        $transaction->setExtraData($requestData->all());
        $this->transactionRepository->save($transaction);

        $response = new RedirectResponse($this->externalBackToShopUrl, "302");
        return new HandlePaymentResponse($transaction, $response);
    }

    /**
     * {@inheritDoc}
     */
    public function handlePaymentNotification(Request $request)
    {
        // no payment notification
    }

}