<?php

namespace Kitano\Bundle\PaymentBundle\Repository;

use Doctrine\ORM\EntityManager;
use Kitano\Bundle\PaymentBundle\Model\Transaction;

class DoctrineTransactionRepository implements TransactionRepositoryInterface
{
    private $entityManager;


    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $id
     *
     * @return Transaction|null
     */
    public function find($id)
    {
        return $this->getRepository('KitanoPaymentBundle:Transaction')->find($id);
    }

    /**
     * @param mixed $transactionId
     *
     * @return Transaction|null
     */
    public function findByTransactionId($transactionId)
    {
        return $this->getRepository('KitanoPaymentBundle:Transaction')->findOneBy(array(
            'transactionId' => $transactionId,
        ));
    }

    /**
     * @param mixed $orderId
     *
     * @return Transaction|null
     */
    public function findByOrderId($orderId)
    {
        return $this->getRepository('KitanoPaymentBundle:AuthorizationTransaction')->findOneBy(array(
            'orderId' => $orderId,
        ));
    }

    /**
     * @param array $criteria
     *
     * @return CaptureTransaction[]
     */
    public function findCaptureBy(array $criteria)
    {
        return $this->getRepository('KitanoPaymentBundle:CaptureTransaction')->findBy($criteria);
    }


    /**
     * @param Transaction $transaction
     *
     * @return void
     */
    public function save(Transaction $transaction)
    {
        $transaction->setUpdatedAt(new \DateTime());
        $this->entityManager->persist($transaction);
        $this->entityManager->flush();
    }

    /**
     * @param string $entityName
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository($entityName)
    {
        return $this->entityManager->getRepository($entityName);
    }

}