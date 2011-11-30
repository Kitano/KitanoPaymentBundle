<?php

namespace Kitano\Bundle\PaymentBundle\Model\Transfer;

class Bic
{
    /* @var string */
    private $bankCode;

    /* @var string */
    private $sortCode;

    /* @var string */
    private $accountNumber;

    /* @var string */
    private $key;

    /* @var string */
    private $domiciliation;


    /**
     * @param string $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param string $bankCode
     */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;
    }

    /**
     * @return string
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * @param string $domiciliation
     */
    public function setDomiciliation($domiciliation)
    {
        $this->domiciliation = $domiciliation;
    }

    /**
     * @return string
     */
    public function getDomiciliation()
    {
        return $this->domiciliation;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $sortCode
     */
    public function setSortCode($sortCode)
    {
        $this->sortCode = $sortCode;
    }

    /**
     * @return string
     */
    public function getSortCode()
    {
        return $this->sortCode;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Validates RIB
     *
     * @return boolean
     */
    public function isValid()
    {
        if (!preg_match('`^(0[1-9]|[1-8]\d|9[0-7])$`', $this->getKey())) {
            return false;
        }

        $accountNumber = strtr(strtoupper($this->getAccountNumber()), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ','12345678912345678923456789');
        $key = 97 - (int) fmod (89 * $this->getBankCode()  + 15 * $this->getSortCode() + 3  * $accountNumber, 97);
        $key = $key < 0 ? '0' . (string) $key : (string) $key;

        return $key === $this->getKey();
    }
}