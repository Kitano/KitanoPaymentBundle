<?php

namespace Kitano\PaymentBundle\Model\Transfer;

use Kitano\PaymentBundle\Model\Transaction;

class TransferTransaction extends Transaction
{
    /* @var Transfer */
    protected $transfer;


    public function __construct(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }

    /**
     * @param Transfer $transfer
     */
    public function setTransfer(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }

    /**
     * @return Transfer
     */
    public function getTransfer()
    {
        return $this->transfer;
    }

}