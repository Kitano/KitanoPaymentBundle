<?php
namespace Kitano\PaymentBundle\PaymentSystem;

use Kitano\PaymentBundle\Entity\Transaction;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HandlePaymentResponse
{
    /** @var null|Transaction */
    protected $transaction = null;

    /** @var null|Response */
    protected $response = null;


    /**
     * @param null|Transaction $transaction
     * @param null|Response $response
     */
    public function __construct(
        $transaction = null,
        $response = null
    )
    {
        $this->transaction = $transaction;
        $this->response = $response;
    }
    /**
     * @param Transaction|null $transaction
     */
    public function setTransaction(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @return Transaction|null
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param Response|null $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}
