<?php

namespace App\PGBundle\CoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 *
 * @ORM\Table(name="user_coins")
 * @ORM\Entity(repositoryClass="App\PGBundle\CoinBundle\Repository\UserCoinsRepository")

 */
class UserCoins
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
    * @ORM\Column(type="decimal", scale=2, nullable=true)
    */
    private $balance;


    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setBalance($balance)
    {
    	$this->balance = $balance;
    }

    public function getBalance()
    {
    	 return $this->balance;
    }
}

 ?>