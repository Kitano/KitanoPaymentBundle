<?php

namespace Kitano\PaymentBundle\Repository;

use Kitano\PaymentBundle\Entity\Transaction;
use Kitano\PaymentBundle\Entity\AuthorizationTransaction;
use Kitano\PaymentBundle\Entity\CaptureTransaction;

interface TransactionRepositoryInterface
{
    /**
     * @param mixed $id
     *
     * @return Transaction|null
     */
    public function find($id);

    /**
     * @param mixed $id
     *
     * @return AuthorizationTransaction|null
     */
    public function findAuthorization($id);

    /**
     * @param mixed $id
     *
     * @return CaptureTransaction|null
     */
    public function findCapture($id);

    /**
     * @param mixed $orderId
     *
     * @return Transaction|null
     */
    public function findByOrderId($orderId);

    /**
     * @param mixed $orderId
     *
     * @return AuthorizationTransaction|null
     */
    public function findAuthorizationByOrderId($orderId);

    /**
     * @param mixed $orderId
     *
     * @return CaptureTransaction|null
     */
    public function findCaptureByOrderId($orderId);

    /**
     * @param Transaction $transaction
     *
     * @return void
     */
    public function save(Transaction $transaction);

    /**
     * @param array $criteria
     *
     * @return Transaction[]
     */
    public function findBy(array $criteria);

    /**
     * @param array $criteria
     *
     * @return AuthorizationTransaction[]
     */
    public function findAuthorizationsBy(array $criteria);

    /**
     * @param array $criteria
     *
     * @return CaptureTransaction[]
     */
    public function findCapturesBy(array $criteria);
}
