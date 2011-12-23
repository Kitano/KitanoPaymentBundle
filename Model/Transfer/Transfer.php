<?php

namespace Kitano\PaymentBundle\Model\Transfer;

class Transfer
{
    /* @var Bic */
    protected $bic;


    /**
     * @param Bic $bic
     */
    public function __construct(Bic $bic)
    {
        $this->bic = $bic;
    }

    /**
     * @param Bic $bic
     */
    public function setBic(Bic $bic)
    {
        $this->bic = $bic;
    }

    /**
     * @return Bic
     */
    public function getBic()
    {
        return $this->bic;
    }
}