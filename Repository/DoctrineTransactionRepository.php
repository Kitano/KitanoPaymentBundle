<?php

namespace Kitano\PaymentBundle\Repository;

use Doctrine\ORM\EntityManager;
use Kitano\PaymentBundle\Model\Transaction;

class DoctrineTransactionRepository implements TransactionRepositoryInterface
{
    private $entityManager;


    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritDoc}
     */
    public function find($id)
    {
        return $this->_find('KitanoPaymentBundle:Transaction', $id);
    }

    /**
     * {@inheritDoc}
     */
    public function findAuthorization($id)
    {
        return $this->_find('KitanoPaymentBundle:AuthorizationTransaction', $id);
    }

    /**
     * {@inheritDoc}
     */
    public function findCapture($id)
    {
        return $this->_find('KitanoPaymentBundle:CaptureTransaction', $id);
    }


    private function _find($model, $id)
    {
        return $this->getRepository($model)->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function findByOrderId($orderId)
    {
        return $this->_findByOrderId('KitanoPaymentBundle:Transaction', $orderId);
    }

    public function findByTransactionIdAndStateDate($transactionId, \DateTime $stateDate)
    {
        return $this->_findByTransactionIdAndStateDate('KitanoPaymentBundle:Transaction', $transactionId, $stateDate);
    }

    /**
     * {@inheritDoc}
     */
    public function findAuthorizationByOrderId($orderId)
    {
        return $this->_findByOrderId('KitanoPaymentBundle:AuthorizationTransaction', $orderId);
    }

    /**
     * {@inheritDoc}
     */
    public function findCaptureByOrderId($orderId)
    {
        return $this->_findByOrderId('KitanoPaymentBundle:CaptureTransaction', $orderId);
    }


    private function _findByOrderId($model, $orderId)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb
            ->select('tr')
            ->from($model, 'tr')
            ->where('tr.orderId = :orderId')
            ->orderBy('tr.createdAt', 'DESC')
            ->setMaxResults(1)
            ->setParameter('orderId', $orderId);

        return $qb->getQuery()->getSingleResult();
    }

    protected function _findByTransactionIdAndStateDate($model, $transactionId, \DateTime $stateDate)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb ->select('tr')
            ->from($model, 'tr')
            ->where('tr.transactionId = :transactionId AND tr.stateDate > :stateDate')
            ->setParameter('transactionId', $transactionId)
            ->setParameter('stateDate', $stateDate);
        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria)
    {
        return $this->_findBy('KitanoPaymentBundle:Transaction', $criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findAuthorizationsBy(array $criteria)
    {
        return $this->_findBy('KitanoPaymentBundle:AuthorizationTransaction', $criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findCapturesBy(array $criteria)
    {
        return $this->_findBy('KitanoPaymentBundle:CaptureTransaction', $criteria);
    }

    private function _findBy($model, array $criteria)
    {
        return $this->getRepository($model)->findBy($criteria);
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