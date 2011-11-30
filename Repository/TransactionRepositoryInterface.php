<?php

namespace Kitano\Bundle\PaymentBundle\Repository;

use Kitano\Bundle\PaymentBundle\Model\Transaction;

interface TransactionRepositoryInterface
{
    /**
     * @param mixed $id
     *
     * @return Transaction|null
     */
    public function find($id);

    /**
     * @param mixed $transactionId
     *
     * @return Transaction|null
     */
    public function findByTransactionId($transactionId);

    /**
     * @param mixed $orderId
     *
     * @return Transaction|null
     */
    public function findByOrderId($orderId);

    /**
     * @param Transaction $transaction
     *
     * @return void
     */
    public function save(Transaction $transaction);

    /**
     * @param array $criteria
     *
     * @return CaptureTransaction[]
     */
    public function findCaptureBy(array $criteria);
}
