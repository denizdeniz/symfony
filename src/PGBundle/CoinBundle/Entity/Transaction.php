<?php

namespace App\PGBundle\CoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="user_transactions")
 * @ORM\Entity(repositoryClass="App\PGBundle\CoinBundle\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $username;

    /**
     * @var decimal
     *
     * @ORM\Column(type="decimal", scale=2, nullable=false)
     */
    private $amount;

    /**
     * @ORM\Column(name="hash", type="string")
     */
    private $hash;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function getAmount(): float
    {
        return $this->amount;
    }


    public function setAmount(float $amount)
    {
        $this->amount = $amount;

        return $this;
    }


    public function getHash()
    {
        return $this->hash;
    }


    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }
}
